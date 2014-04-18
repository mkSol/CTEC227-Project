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

  Login Screen
    view based on access level OR role
    
##   List Tickets
    view based on access level OR role
    ability to sort tickets
    
##   Accept/Take Tickets
  
##   Update Tickets
  
## Administration

  New system user
  CRUD Users
  CRUD Tickets 
  
  I have a note about ticket removal. Probably an admin function for a mistaken ticket entry. 
  NOTE: CRUD is short for Create Read Update Delete not what w think of users or tickets
  
  Notes On Listing Screen
    Listings to filter by status/date/user/tag/type assigned/unassigned open/closed
    
    Some of the data fields we will need are 
    priorty
    status
    notes
    type (cannot read my own notes on this)
    Ticket tag
    dept
    
    Tables
    ticket table
    user table
    equipment
    Installed Software table ( this was added after our meeting with Mr Greenwell)
    
    We will need a separate table for hardware linked to users
    What we are saying is a Greenwell employee uses a computer and we are listing that relationship in data tables.
    
    
    Existing System
    
    There is no existing computer based system. 
    What occurs as I have observed is that Mary down in accounting calls her best frind Sally on the help desk and she gets more memory for her computer while IT has 286's.  
    
    User Cases
    
    Frankly this needs some work
    
    Error Handling
    
      Log non critical errors
      minimum information to user on failure
    
    
    Security
    
    Not in the scope of this project
    Users will use the Greenwell LAN ( local Area Network )
    No access allowed outside the lan (Per Mr Greenwell)
    
    Help
    
