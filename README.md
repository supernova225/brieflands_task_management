## Task Manager

In this project, after registration, the user can define her/his "tasks" and then put them in the desired "statuses". It can also set a "deadline" to "finish" the task.

## Structures

"[Laravel](https://laravel.com/)" framework and "[MySQL](https://www.mysql.com/)" database are used for the "backend" of the project and implemented as "[Restful API](https://aws.amazon.com/what-is/restful-api/#:~:text=RESTful%20API%20is%20an%20interface,applications%20to%20perform%20various%20tasks.)".
Due to the use of "[Laravel](https://laravel.com/)", the system architecture is "[MVC](https://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller)".

## Models & Migrations

In this system, we have used "User" and "Task" "[Models](https://laravel.com/)", which have a one-to-many relationship.
For each model, there is a "migration" that is responsible for creating tables in the database.

## Policy

Because only the person who created the "task" can edit or delete the desired "task", "policies" have been used in such a way that it is checked after the request for editing or deletion to make sure that Only the "task" owner can edit or delete the task

## Resources & Resource Collections

In this project, we have used other facilities such as "Resources" and "Resource Collections".
By using these facilities, the desired "API" output can be sent to the "Front End" in a centralized and regular manner.

## Security

For the security of the system, the authentication package "[Sanctum](https://laravel.com/docs/10.x/sanctum#main-content)" has been used, and due to the system's "Restful API", token has been used for authentication in order to provide a safe environment for creating and publishing posts.

