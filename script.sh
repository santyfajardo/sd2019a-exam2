#!/bin/bash
while true
do
	x= `$(($RANDOM%2))`
	if [$x -eq 1]
	then
  		curl 192.168.130.160:8080
		sleep 2
	else 
		curl 192.168.130.160:8080/mala
		sleep 2
	fi
done
