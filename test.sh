function lintalljson() {
  for f in $1
  do
    lintjson $f
  done
}

function lintjson() {
  echo "--> lint json file $f"
  jsonlint --quiet --compact $1
}

lintalljson "*.json"
lintalljson "data/*.json"
