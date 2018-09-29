#!/usr/bin/env bash
function lintJsonFiles() {
  for file in $1
  do
    lintJson ${file}
  done
}

function lintJson() {
  echo "--> linting JSON file $file"
  jsonlint --quiet --compact $1
}

lintJsonFiles "*.json"
lintJsonFiles "data/*.json"
