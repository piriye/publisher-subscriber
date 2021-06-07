<?php

namespace App\Handlers\FileHandlers;

use Exception;

use App\Handlers\BaseHandler;
use App\Interfaces\FileImportInterface;
use App\Utilities\DateUtils;

class Json extends BaseHandler implements FileImportInterface
{
    private $typeName = 'json';

    public $user;
    public $processedFile;

    public function __construct($user, $processedFile) {
        parent::__construct($this->typeName);

        $this->user = $user;
        $this->processedFile = $processedFile;
    }

    public function processFile($filepath, $processedFile)
    {
        $jsonData = json_decode(file_get_contents($filepath), true);

        if ($processedFile == null) {
            $processedFileEntry = [
                'name'                  => $filepath,
                'total_num_of_entries'  => count($jsonData),
            ];

            $processedFile = $this->processedFile->create($processedFileEntry);
            $processedFile->refresh();
        }

        $processedCount = $processedFile->num_of_processed_entries;
        $totalEntries = $processedFile->total_num_of_entries;

        try {
            for ($i = $processedCount; $i < $totalEntries; $i++) {
                $processedFile->increment('num_of_processed_entries');

                $entry = $jsonData[$i];

                $date = DateUtils::getDateObjectFromDateString($entry['date_of_birth']);
                $age = DateUtils::getAgeFromDateOfBirth($date);

                if (!$this->isValidAge($age)) {
                    continue;
                }

                if (isset($entry['credit_card']) && !$this->isValidCardNumber($entry['credit_card']['number'])) {
                    continue;
                }

                $user = $processedFile->users()->create($entry);

                $entry['credit_card']['expiration_date'] = $entry['credit_card']['expirationDate'];
                $user->cards()->create($entry['credit_card']);

                $processedFile->increment('num_of_valid_entries');
            }
        } catch (Exception $ex) {
            dd($ex);
        }
    }
}
