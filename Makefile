build:
	docker build -t itoph2018 .

prod:
	docker build -t registry.it.kmitl.ac.th/it60070090/it-openhouse-2018 .

push:
	docker push registry.it.kmitl.ac.th/it60070090/it-openhouse-2018

run:
	docker-compose -f docker-stack-dev.yml up

update:
	kubectl set image -n it-openhouse deployment/openhouse-2018 openhouse-2018=registry.it.kmitl.ac.th/it60070090/it-openhouse-2018@sha256:$(TAG) && kubectl rollout status deployment/openhouse-2018 -n it-openhouse
