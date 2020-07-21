#!/bin/bash

###
### my-script — does one thing well
###
### Usage:
###   my-script <input> <output>
###
### Options:
###   <input>   Input file to read.
###   <output>  Output file to write. Use '-' for stdout.
###   -h        Show this message.

help() {
  sed -rn 's/^### ?//;T;p' "$0"
}

# if [ ${#@} -ne 0 ] && [ "${@#"--help"}" = "" ]; then
#   printf -- '...help...\n'
#   exit 0
# fi

if [[ $# == 0 ]] || [[ "$1" == "-h" ]]; then
  help
  exit 1
fi
