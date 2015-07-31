# Fork to Demo Bug

In a nutshell, the relation manager / relation controller in the backend forms doesn't work with belongsTo relationships (see issue: https://github.com/octobercms/october/issues/1329). When saving the dependant (slave) record, the master record is also saved whether or not it has already been created. This results in the creation of two master records, one that's blank except for the relation to the slave, and one that contains the save fields.

## Pull Requests

I've created two pull requests (https://github.com/octobercms/october/pull/1330 and https://github.com/octobercms/library/pull/125) which enable deferred binding for belongsTo relationships. If you think this is a weird idea, you're very astute, but probably haven't read the issue and its first comment yet which explains why this is one of a couple possible solutions.

If you merge these small changes into your own code base, the follow steps will yield a successful test. If you leave them out, you will experience the current bug.

## Steps to Reproduce (well, in one sense of the word, not in the other)

1. Install this plugin (`git clone git@github.com:lthurston/oc-test-plugin.git plugins/october/test`)
2. In the backend, click Playground
3. In the side nav, click People
4. Click Manage Phones
5. Click + New Phone
6. Under "Alternate Views" click "Relation Controller"
7. Click "Create Person"
8. Add a name to the new person and save
9. Add a name to the phone and save
10. Check your october_test_phones table and note the creation of two records. Note the differences between the records.

Here's where this happens:

https://github.com/octobercms/october/blob/master/modules/backend/behaviors/RelationController.php#L897

Thanks to alxy and jraw in the IRC channel for helping me suss through this and try some things. I'd love to get this fixed, and am happy to work on it myself with some guidance from the core team.


# Test Plugin

This is a UI test plugin for OctoberCMS. Extract this archive to `/plugins/october/test` and click on **Playground** in the back-end area.

The following sections are explored, tested and demonstrated along with a list of the features used:

### Test 1: People

A Person "Has One" Phone (One to one relationship)

1. Relation Controller
1. Record Finder
1. Proxy Form fields
1. Date pickers
1. Context-based Form fields

### Test 2: Posts

A Post "Has Many" Comments (One to many relationship)

1. Relation Controller
1. Popup-based Form fields
1. Rich Editor
1. Dual Form Controller and List Controller

### Test 3: Users

User "Belongs To Many" Roles (Many to many relationship)

1. Relation Controller
1. Image Uploaders (Single, Multi, File, Image)
1. Number field

### Test 4: Countries

A Country "Has Many" Posts "Through" a User (Has many through relationship)

1. Checkbox list
1. Default form field values

### Test 5: Reviews

Reviews "Morph To" Plugins and Themes as Product (Polymorphic relationship)


## Tests that need attention

- An attach relation when required inside a tab does not make the tab active.

- Proxy fields throw a nasty error when the relation is non existant.

- Deleting multiple Comments from a Post (deferred) only deletes one comment.

- Constrained relations should not appear in RecordFinder (Phone:is_active) and Relation Controller lists (Comment:is_visible).

## Incorporating functional tests

- All relation controllers

- Test that input preset API works on fields

- Test that trigger API works on fields
