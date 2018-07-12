build:
	docker build -t itoph2018 .

prod:
	docker build -t registry.gitlab.com/itforge-eros/itoph2018 .

push:
	docker push registry.gitlab.com/itforge-eros/itoph2018

run:
	docker-compose -f docker-stack-dev.yml up

update:
	kubectl set image -n openhouse deployment/openhouse2018 openhouse2018=registry.gitlab.com/itforge-eros/itoph2018@sha256:$(TAG) && kubectl rollout status deployment/openhouse2018 -n openhouse