#!/bin/sh

composer install --no-cache --prefer-dist --no-dev --no-scripts --no-progress

apache2-foreground
