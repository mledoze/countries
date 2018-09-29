function lintJsonFiles() {
  for f in $1
  do
    lintJson ${f}
  done
}

function lintJson() {
  echo "--> linting JSON file $1"
  jsonlint --quiet --compact $1
}

lintJsonFiles "*.json"
lintJsonFiles "data/*.json"
