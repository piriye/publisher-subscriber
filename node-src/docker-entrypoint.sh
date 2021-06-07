#!/bin/bash

cd /home/pangaea-node-subscriber

yarn

yarn tsc

# knex migrate:latest

pm2-runtime start ecosystem.config.js
