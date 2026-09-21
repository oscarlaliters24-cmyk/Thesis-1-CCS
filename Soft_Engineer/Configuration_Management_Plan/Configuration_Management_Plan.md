# Configuration Management Plan

## Senior Citizen Information Management System

### 1. Purpose

The Configuration Management Plan provides a simple process for managing, organizing, tracking, and updating the project files, source code, database, documentation, and system versions throughout development.

### 2. Configuration Items

| Item | How it will be managed |
|---|---|
| PHP/Laravel code | GitHub |
| HTML/CSS/JavaScript | GitHub |
| Database structure | Laravel migrations + GitHub |
| Database test data | Local MySQL/XAMPP |
| System documentation | Google Drive/Word + GitHub README |
| ERD/diagrams | Project documentation folder |
| Test cases/results | Project documentation folder |
| `.env` settings | Local computer only |
| Final system | GitHub `main` branch |

### 3. Folder Structure

```text
osca-senior-system/
├── app/
├── database/
├── public/
├── resources/
├── routes/
├── tests/
├── docs/
│   ├── requirements/
│   ├── diagrams/
│   ├── test-results/
│   └── documentation/
├── .env.example
├── .gitignore
├── composer.json
└── README.md
```

### 4. Version Management

GitHub will be used to keep track of project changes.

- v0.1.0 – Initial system
- v0.2.0 – Senior citizen records
- v0.3.0 – Benefits
- v0.4.0 – QR verification
- v0.5.0 – Analytics
- v0.6.0 – User roles
- v1.0.0 – Final system

### 5. GitHub Branch Management

```text
main
└── development
```

For larger changes:

```text
main
└── development
    ├── qr-feature
    ├── analytics-feature
    └── user-access-feature
```

- `main` – stable version
- `development` – current working version
- Feature branches – temporary branches for specific features

### 6. Change Management

```text
Request Change
      ↓
Check the reason
      ↓
Make the change
      ↓
Test the change
      ↓
Commit to GitHub
      ↓
Merge to development
      ↓
Review
      ↓
Merge to main
```

### 7. Change Log

| Date | Change | Person | Status |
|---|---|---|---|
| | | | |
| | | | |
| | | | |
| | | | |

### 8. Commit Management

Use clear commit messages.

Examples:

- Add QR verification scanner
- Fix senior citizen validation
- Add benefit monitoring
- Update dashboard analytics
- Fix staff permissions

Avoid unclear messages such as `update` or `fix`.

### 9. Backup Management

- Source code → GitHub
- Database → MySQL `.sql` backup
- Documents → Google Drive/local backup
- Final version → GitHub `main` branch and separate backup

### 10. Security Management

Do not upload `.env` to GitHub.

Use `.env.example` instead.

Real passwords, API keys, database credentials, and real senior citizen personal information must not be placed in the repository.

### 11. Release Management

```text
Development
     ↓
Testing
     ↓
Bug fixing
     ↓
User review
     ↓
Final approval
     ↓
main branch
     ↓
Release
```

The approved final thesis prototype may be identified as:

**OSCA Senior Citizen Information Management System v1.0.0**

### 12. Team Responsibilities

| Person/Role | Responsibility |
|---|---|
| Project Leader | Manage GitHub and project versions |
| Developer | Develop and commit code |
| Database Manager | Manage MySQL and database backups |
| Tester | Test new features |
| Documentation Manager | Maintain documents and change log |
| All Members | Report bugs and requested changes |

### 13. Manageable Configuration Management Approach

The project will use five basic configuration management practices:

1. GitHub for source-code management
2. `main` and `development` branches
3. A simple change log
4. Regular database backups
5. Version numbers for major releases

This approach keeps configuration management practical and manageable for the student development team.
