```
docker build -t go-app-img .
docker run -d -p 3333:3000 --rm --name go-app-container go-app-img

docker build -t kevinyan001/kube-go-app .
docker push  kevinyan001/kube-go-app
docker pull kevinyan001/kube-go-app:latest

minikube start

kubectl create -f deployment.yaml
kubectl get deployments
kubectl get pods

kubectl expose deployment my-go-app --type=NodePort --name=go-app-svc --target-port=3000
kubectl get svc

minikube ip
```
