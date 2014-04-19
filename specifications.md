# Specifications 

General

This project seeks to create a functional IT Help Desk and Asset Management system for Greenwell Bank. It will be a web-based system where users will log in and, depending on their role in the bank, will be able to submit, view, take, release, and close tickets for IT help desk. Additionally, it will keep track of the computer hardware and software assets of employees and departments within the company.

Personas (In order of priviledge level. Higher levels inherit abilities of lower tiers.)
  General User
    -Able to create tickets
    -Able to view his/her own submitted tickets and view the status of them
  Help Desk
    -Able to view all tickets
    -Can take tickets and assign them to themselves
    -Able to add comments and updates to tickets they are assigned to
    -Can change status of tickets (open/closed-solved/closed-nofix/taken)
    -View assets assigned to ticket creator or department
  Manager
    -Able to view all tickets
    -Able to view all assets
  Sys Admin
    -Create, read, write, and modify all tickets and assets
  
All are assumed to be an employee or contractor

## Function  - High Level

### Login Screen
    
View based on access level OR role
All users will be required to login 
    
### List Tickets

View based on access level OR role

For the General User this will list tickets they opened & are still active.
Will include ability to sort tickets.

For the helpdesk Admin and Manager all tickets are listed.
Filters can be applied and data can be sorted.

### Accept/Take Tickets (Create Ticket)

All users will be able to create a trouble ticket.
Screen will enable user to select an asset and describe the problem.
  
### Update Tickets

Helpdesk and Manager can assign tickets and update status.
  
### Administration

Helpdesk and Manager can add assets software and software versions.

~~New system user~~
~~CRUD Users~~
~~CRUD Tickets~~
  
~~I have a note about ticket removal. Probably an admin function for a mistaken ticket entry.~~
~~NOTE: CRUD is short for Create Read Update Delete not what w think of users or tickets~~

### Notes On Listing Screen

Listings to filter by status/date/user/tag/type assigned/unassigned open/closed

#### Other Notes

###### * Marc has complete notes on schema development    
Some of the data fields we will need are 
priorty
status
notes
type 
Ticket tag
dept

Tables
ticket table
user table
equipment
Installed Software table ( this was added after our meeting with Mr Greenwell)

We will need a separate table for hardware linked to users
What we are saying is a Greenwell employee uses a computer and we are listing that relationship in data tables.
    
    
### Existing System
    
There is no existing computer based system.

~~What occurs as I have observed is that Mary down in accounting calls her best frind Sally on the help desk and she gets more memory for her computer while IT has 286's.~~
    
### User Cases

For the GRIPE system we will use "persona's" to tease out the requirements.

Persona defined: 
**Wikipedia**

    In marketing and user-centered design, personas are fictional characters created to represent the different user types within a targeted demographic, attitude and/or behavior set that might use a site, brand or product in a similar way.
    A user persona is a representation of the goals and behavior of a hypothesized group of users.

## Persona's

#### For the *General User* we will have Tom and Gery.

Tom is a technical writer and provides office staff support at Greenwood.
Tom is a new employee. 
He attends college and is studying IT.

Gery is a senior teller and has worked with Tom.
She feels that her computer problems should receive top priority

#### For the *Help Desk* we will have Harvey and Hurley.

Harvey has worked the help desk for two years.
Harvey looks forward to GRIPE going into production.
He wants to help with the testing.

Hurley is Harvey's boss and leads the helpdesk team.
Hurley is not sure we can come through with a system that will help. 
Hurley want a system that is faster than what he uses

#### For the *Executive* we will have Bubba and Gertrude.

Bubba owned Greenwood Bank. 
Bubba looks forward to GRIPE going into production.
He wants to save money and get better use from his help staff.

Gertrude is the COO at Greenwood.
Mostly her secretaries use her computers.

#### Sys Admin will be Slim 

Slim will have access to more screens and will require less time to train.

~~Frankly this still needs a little more work~~ 

### Error Handling

Log non critical errors
Minimum information to user on failure
   
    
### Security
    
Not in the scope of this project
Users will use the Greenwell LAN ( local Area Network )
No access allowed outside the lan (Per Mr Greenwell)
    
## Help
    
The GRIPE team will stage training sessions.
