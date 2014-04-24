# Specifications for Greenwell Incident Report Service (IRS)

### The Team
1. Patrick Barnes
2. Marc Kleefstra
3. Earle Cottingham

#### *Roles for team members as follows

|Patrick          | Marc            | Earle           |
|:---------------|:---------------|:---------------|
|Project Mgr      |Lead Programmer  |Lead Tester      |
|Design Test Plan |DBA              |Programmer       |
|User Experience  |Process Design   |Training Liaison |
|Documentation    |Test Design      |Interface Review |
|Production Checklist|Migration Plan|System Testing |

###### Rules of Engagement/Conduct 

* Vision
* Values
* Respect
* Integrity
* Communication
* Excellence

Source:

    Enron Code of Ethics: Page 4


### General

This project seeks to create a functional IT Help Desk and Asset Management system for Greenwell Bank. It will be a web-based system where users will log in and, depending on their role in the bank, will be able to submit, view, take, release, and close tickets for IT help desk. Additionally, it will keep track of the computer hardware and software assets of employees and departments within the company.

IRS will be designed to handle 2000 users. 
Users of the IRS system should expect screen response time less than 700 milliseconds.


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

## Screen Functions

Four screens will be developped:
* Login
  * Required for all IRS users
* List Tickets  
  * Read only view of IRS tickets 
* Update Tickets
  * Manager and Helpdesk access
* Delete Tickets
  * System Adminstrator access  

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

### Notes On Listing Screen

Listings to filter by status/date/user/tag/type assigned/unassigned open/closed

#### Additional Notes on screen development

Because of the timeline for this project IT will populate asset and software values.
Scripts can be provided to System Administrator for system maintenance.

Error Listing for system administration can be performed with scripts.

We propose to defer developing CRUD screens for asset and software.
Additionally screens to list errors could be deferred to the next release of IRS.

This will allow rigorous testing and smoother production implementation.

Note: CRUD is an acronym for Create, Read, Update and Delete.
   
### Existing System
    
There is no existing computer based system.
No systematic method to track harware and sofware life cycles.

Employees with computer problems cannot find the status of there problem with out an interupting phone call or vist to person trying to correct the problem.

### Disaster Preparedness

Paper forms will be developed to log problems.

Should the IRS system not be accessable forms will be deployed for problems resolution.

The data can be entered after the system is restored.

### User Cases

For the IRS system we will use "Persona's" to tease out the requirements.

Persona defined: 
**Wikipedia**

    In marketing and user-centered design, personas are fictional characters created to represent the different user types within a targeted demographic, attitude and/or behavior set that might use a site, brand or product in a similar way.
    A user persona is a representation of the goals and behavior of a hypothesized group of users.

## Persona's

#### For the *General User* we will have Tom and Gery.

Tom is a technical writer and provides office staff support at Greenwell.
Tom is a new employee. 
He attends college and is studying IT.

Gery is a senior teller and has worked with Tom.
She feels that her computer problems should receive top priority

#### For the *Help Desk* we will have Harvey and Hurley.

Harvey has worked the help desk for two years.
Harvey looks forward to IRS going into production.
He wants to help with the testing.

Hurley is Harvey's boss and leads the helpdesk team.
Hurley is not sure we can come through with a system that will help. 
Hurley wants a system that is faster than what he uses today.

#### For the *Executive* we will have Günther and Gertrude.

Günther owned Greenwell Bank up until when he sold a controlling interest. 
Günther looks forward to IRS going into production.
He wants to save money and get better use from his help staff.
There has been increasing pressure from the stock holders to streamline operations.
Günther has started 4 projects at Greenwell in the las couple of weeks.


Gertrude is the COO at Greenwell. Mostly her secretaries use her computers.
Those that can recall the old days remember the time Gertrude stuffed two floppies into one slot on her computer.

#### Sys Admin will be Slim 

Slim will have access to more screens and will require less time to train.



##### A typical day with IRS in production.

Tom had a problem with his computer. He cannot read a document from Gery written on Wordy V5.
Tom has Wordy V4 and it will not open Gery's document.

Tom logs in to IRS with his employee number and password.
Slim has set up employees & passwords prior to this.
Tom selects his computer from a list and selects Wordy v4.
Again Slim has done the foot work and entered hardware, software and assigned it to employees.
Tom enters a description of the problem.

Gery has a problem with the printer used in her office. She signs in to IRS and
is presented with list of her computers and the printer. She slects the printer (no version required) and describes the problem.

Meanwhile on the helpdesk Harvey and Hurley are monitoring activity on IRS.
Hurley see the request from Gery. He calls the service company to get the paper clip out of the copier. Harvey notices the request from Tom and immediately updates the IRS ticket with an assigned status. Harvey puts in a request to upgrade Tom version of Wordy.

An hour later Hurley get a call from Gery about her printer. Hurley updates the status of the IRS ticket and tells Gery the service has been called.

Günther logs in to IRS and is presented with a list of all the tickets.
After sorting and filtering he notices the time between opening a request and when it is assigned on Gery's ticket with the printer. He makes a not to ask Hurley about that.

Gertrude spoke with Slim and he created a special data extract for her. She is mining the data to see how long computers last and anticipate when a new ones will be required.


### Error Handling

Log non critical errors.
Minimum information to user on failure.
System Administrator will be able to list errors and follow up with corrections.
    
### Security
 
A air tight secure system is not required for this project.
Users will use the Greenwell LAN ( local Area Network )
No access allowed outside the lan (Per Mr Greenwell)

We will provide a system safe from SQL code injection.

Password requirement will follow guidelines set forth in the _Enron Code of Ethics_ 
    
    Page 35 first two paragraphs

    
## Help
    
The IRS team will stage training sessions.
We will also work with technical writing to develop IRS use guides.

#### Initial thoughts on application design approach

###### Marc has complete notes on schema development    
Some of the data fields we will need are:

* status
* notes
* type 
* ticket tag
* dept

Tables
* ticket table
* user table
* equipment
* installed software table 

## Request for Specification Sign off

- [x] Project Functional Specification
- [x] Rules of Engagement
- [x] Team member roles and responsibilities
- [x] Initial thoughts on application design approach

- [ ] Sign off from Mr Greenwell

- [ ] Approve 
- [ ] Approve with changes