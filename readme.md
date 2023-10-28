# Installation
best way to install this app is to use docker compose
```bash
docker compose up -d
```

# Editing user parameters
1. Add, remove or change model in ```App\DTO\EmployeeDTO.php```
2. update according to your change form in ```App\Forms\EmployeeFormFactory```
3. migrate xml data file with default location ```PROJECT_DIR/employees.xml```
