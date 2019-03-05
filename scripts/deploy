#!/usr/bin/env bash
set -e
DEPLOY_PATH=$DEVELOPMENT_PATH
if [ $TRAVIS_BRANCH = "master" ]; then DEPLOY_PATH=$PRODUCTION_PATH; fi
rsync -r --delete-after --quiet $TRAVIS_BUILD_DIR/ --exclude-from=$DEPLOY_IGNORE $SSH_USER@$SSH_HOST:$DEPLOY_PATH
