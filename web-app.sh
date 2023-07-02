#!/bin/bash
apt update -y
apt -y install python3-pip zip
cd /opt
wget "https://d6opu47qoi4ee.cloudfront.net/loadbalancer/simuapp-v1.zip"
unzip simuapp-v1.zip
rm -f simuapp-v1.zip
sed -i 's/MOD_APPLICATION_NAME/LiftShift-Application/' templates/index.html
pip3 install -r requirements.txt	
nohup python3 simu_app.py >> application.log 2>&1 &
