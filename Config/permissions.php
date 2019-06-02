<?php

return [
    'contact.contacts' => [
        'index' => 'contact::contacts.list resource',
        'create' => 'contact::contacts.create resource',
        'edit' => 'contact::contacts.edit resource',
        'destroy' => 'contact::contacts.destroy resource',
        'contact_categories'=>'contact::contacts.contact_categories resource',
    ],
// append'
'contact.extra' => [
'ANSWER_view'=> 'category::categories.ANSWER_view resource',
'ANSWER_edit'=> 'category::categories.ANSWER_edit resource',
'END_view'=> 'category::categories.END_view resource',
'END_edit'=> 'category::categories.END_edit resource',
  'EMAIL_view'=> 'category::categories.EMAIL_view resource',
  'IS_ACTIVE_view'=> 'category::categories.IS_ACTIVE_view resource',
  'MESSAGE_view'=> 'category::categories.MESSAGE_view resource',
  'NAME_view'=> 'category::categories.NAME_view resource',
  'CONTACT_SUBJECT_ID_view'=> 'category::categories.CONTACT_SUBJECT_ID_view resource',
  'SURNAME_view'=> 'category::categories.SURNAME_view resource',
  'PARENT_ID_view'=> 'category::categories.PARENT_ID_view resource',
  'IS_READ_view'=> 'category::categories.IS_READ_view resource',
'EMAIL_edit'=> 'category::categories.EMAIL_edit resource',
  'IS_ACTIVE_edit'=> 'category::categories.IS_ACTIVE_edit resource',
  'MESSAGE_edit'=> 'category::categories.MESSAGE_edit resource',
  'NAME_edit'=> 'category::categories.NAME_edit resource',
  'CONTACT_SUBJECT_ID_edit'=> 'category::categories.CONTACT_SUBJECT_ID_edit resource',
  'SURNAME_edit'=> 'category::categories.SURNAME_edit resource',
  'PARENT_ID_edit'=> 'category::categories.PARENT_ID_edit resource',
  'IS_READ_edit'=> 'category::categories.IS_READ_edit resource',
]

];
