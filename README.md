# README.md

Crimson Tiangco (a2e exam)

## Instruction on how to run this application using docker

- Make sure you have docker installed on your machine
- Clone the application repository.
- Edit the **models/Main.php** file to match your database credentials.
- Open the **init-db.sql** file and execute the SQL scripts in your MySQL query tool.

```
docker build -t a2e .
docker run -p 8085:80 a2e

# or run this command if your MySQL is containerized with a specified network:
docker run -p 8085:80 --network my-docker-network a2e
```

Open your browser and navigate to **http://localhost:8085/dashboard/**
