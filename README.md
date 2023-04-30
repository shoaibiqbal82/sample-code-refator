The application architecture doesn’t seem to follow design principles DRY | SOLID etc., which leads this codebase to poor readability, repetition, harder to test, fat controllers/models/repositories etc.

I will add more layers of services/resource classes/notifications etc, that will increase code readability, maintainability, scalability and testability. The final architecture will be as follows:

Models: with responsibility to interact with database tables/relationships etc.

Resource (Transformers): with responsibility to transform data into Array/JSON

Repositories: perform data access and persistence encapsulation for particular implementation allowing easy interchangeability.

Services: with responsibility to implement the business and complex logic.

Controllers: with responsibility to receive the request, pass data for processing to appropriate services, and return the processed data as a response.

Notifications: with responsibility to send all emails/SMS to users/customers/translator/admin etc.

Here are the sample refactorings along with potential issues and their resolution/suggestions.

Added booking service which will hold all business logic and will fetch data from different repositories, will act as binding glue for diff repositories to get data for manipulation via business logic in service and then return this to controller.
Repositories are broken down into userRepository and jobRepository so that they are responsible for fetching and storing data related to their models/data sources only.
Notifications are added for each type of events so that that code doesn’t clutter service or repository.
Resources are created for each model and responsible for formatting data for response objects etc.
There are also some comments for best practices I have put in code.
A test is also created to test a helper function.

Following is the link to Github repo.




