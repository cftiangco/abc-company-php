#!/bin/bash

network=$1

docker run -p 8085:80 -v $(pwd):/var/www/html --network $network abc