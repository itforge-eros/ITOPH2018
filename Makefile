build:
	docker build -t itoph2018 .

prod:
	docker build -t asia.gcr.io/k-wiput-me/letseatinthai .

push:
	gcloud docker -- push asia.gcr.io/k-wiput-me/letseatinthai:latest

run:
	docker-compose -f docker-stack-dev.yml up