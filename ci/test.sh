function lintAllJSON() {
  for f in $1
  do
    lintJSON $f
  done
}

function lintJSON() {
  echo "--> lint json file $f"
  jsonlint --quiet --compact $1
}

lintAllJSON "*.json"
lintAllJSON "data/*.json"
