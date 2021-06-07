export class GenericResponseError extends Error {
  constructor(readonly code: number, readonly message: string) {
    super(message);
  }
}
