#!/bin/bash

if [ -n $REPORT_COVERAGE ]; then
    if [ "$REPORT_COVERAGE" == "true" ]; then
        echo "Reporting coverage..."
        curl -X POST -d @codeclimate.json -H 'Content-Type: application/json' -H 'User-Agent: Code Climate (PHP Test Reporter v0.1.1)' https://codeclimate.com/test_reports
    else
        echo "Not reporting coverage..."
    fi
fi
