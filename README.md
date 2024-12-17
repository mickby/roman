# Roman Numerals Tech Task
This development task is based on the simple process of converting Roman numerals. 
This task requires you to build a JSON API and so any HTML, CSS or JavaScript that is submitted will not be reviewed.

## Brief
Our client (Numeral McNumberFace) requires a simple RESTful API which will convert an integer to its 
Roman numeral counterpart. After our discussions with the client, we have discovered that the solution 
will contain three API endpoints, and will only support integers ranging from 1 to 3999. 
The client wishes to keep track of conversions so they can determine which is the most frequently converted integer, and the last time this was converted.

### Endpoints Required
1. Accepts an integer, converts it in to a Roman numeral, stores it in the database 
and returns the response. [x]
2. Lists all the recently converted integers. [x]
3. Lists the top 10 converted integers. [x]

## What we are looking for
- Use of MVC components (View in this instance can be, for example, a Laravel Resource).
- Use of [Fractal](https://fractal.thephpleague.com/) or [Laravel Resources](https://laravel.com/docs/eloquent-resources)
- Use of Laravel features such as Eloquent, Requests, Validation and Routes.
- An implementation of the supplied interface.
- The supplied PHPUnit test passing.
- Clean code, following PSR-12 standards.
- Use of PHP 8.3 features where appropriate.

Please also include a short explanation of your approach, including any design decisions you have made and the reasons for those decisions.

## Submission Instructions
Please create a [git bundle](https://git-scm.com/docs/git-bundle/) and send the file across:
```
git bundle create <yourname>.bundle --all --branches
```

## 🚀 Explanation of Approach

### 🧪 RomanAPITest
I started with this because I prefer a **Test-Driven Development (TDD)** approach, especially for APIs.  
I always opt for **named routes** and **HTTP constants** because they provide a cleaner look.  
For simplicity and speed, I used **SQLite** (along with **Laravel Sail**).  
To ensure that all tests run in isolation, I utilized the **RefreshDatabase** trait.

I created a migration and model for the **Conversion** table. Initially, I considered having a single row for each numeral and incrementing a count for each conversion. However, I decided to create a new row for each conversion and let SQL handle the summing, as I believe in keeping things as simple as possible.

At the last minute, I added some **validation tests** for completeness. I usually consider these unnecessary since they primarily test Laravel's built-in functionality.

### 🌐 Routing
Routes are defined in **api.php** instead of **web.php** because we are building an API.  
I prefer to use **Resource Controllers** whenever possible, but there was no need for them here.

### 📋 Form Request
I favor using **Form Requests** for validation to keep my controller as slim as possible.

### 🛠️ Controller
I leverage **Eloquent** as much as possible.  
Initially, I was unsure what "recent" conversions meant, so I opted to return those from the current day.  
I started with my Eloquent queries in the controller but later moved them to **scopes** for reusability and to clean up the controller.

While I could have implemented the **Repository Design Pattern**, I deemed it unnecessary in this case.  
I also considered adding pagination for recent conversions but felt it was overkill for this simple task (though it's very straightforward in Laravel).

### 📦 API Resources
I utilized **Resources** for API responses, which is quite simple in this case but invaluable in real-world applications.  
Additionally, I employed a **Resource Collection** for multiple records, which is handy for adding metadata.

### 🏭 Model Factories
I consistently use **Model Factories** to seed test data, as taught by Jeffrey Way.

### 🔌 Implementation of Interface
The service class implements the **IntegerConverterInterface**, allowing us to code to an interface rather than a concrete class.  
This results in **inversion of control**, making it easier to swap implementations. The binding and resolution are handled in the **Service Container**.

### ✅ Tests
All tests pass, with a few additional ones completed for TDD. This gives us confidence in the application, especially when modifying other areas of the codebase.
