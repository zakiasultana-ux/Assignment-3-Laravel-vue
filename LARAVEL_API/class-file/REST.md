# REST APIs

What are they?
They are the defacto standard for API implementations on the web.


REST = REpresentational State Transfer

API = Application Programming Interface

## What principles does REST implement? (Is my application considered "RESTful"?)

- Client-Server Architechture
    - "Client" as in a piece of software, not someone who pays you!
    - A separated "Client" (web browser, Postman, etc.) and a "Server" that act and can be developed independently
- Statelessness*
    - Each request contains ALL the information needed to perform whatever action it is trying to accomplish; it CANNOT use any leftover or stored data from a previous request.
    - This is _different_ from storing stuff in a database; databases are not considered "state" for an API.
- Cacheability
    - Responses can be cached (stored temporarily for performance)
- Uniform Interface*
    - API URLs and endpoints follow a standard convention / format.
- Layered System
    - Clients (not the people who pay you) cannot determine if they are directly connected to the server or if they have gone through one or more intermediaries
- Code on Demand
    - Servers can _optionally_ send code that can be executed.
