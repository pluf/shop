<?php
// Import
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use GraphQL\GraphQL;
use GraphQL\Type\Schema;
/**
 * Render class of GraphQl
 */
class Pluf_GraphQl_Schema_Pluf_Paginator_Shop_Category {
    public function render($rootValue, $query) {
        // render object types variables
         $Shop_Category = null;
         $CMS_Content = null;
         $User_Account = null;
         $User_Group = null;
         $User_Role = null;
         $User_Message = null;
         $User_Profile = null;
         $User_Avatar = null;
         $User_Verification = null;
         $User_Email = null;
         $User_Phone = null;
         $User_Address = null;
         $Tenant_Comment = null;
         $Tenant_Ticket = null;
         $Shop_Order = null;
         $Bank_Receipt = null;
         $Bank_Backend = null;
         $Tenant_Invoice = null;
         $Tenant_BankReceipt = null;
         $Tenant_BankBackend = null;
         $Pluf_Tenant = null;
         $Shop_Zone = null;
         $Shop_Agency = null;
         $Shop_OrderMetafield = null;
         $Shop_OrderItem = null;
         $Shop_OrderItemMetafield = null;
         $Shop_OrderHistory = null;
         $Shop_OrderAttachment = null;
         $Shop_Address = null;
         $Shop_Contact = null;
         $Shop_CategoryMetafield = null;
         $Shop_Delivery = null;
         $Shop_Tag = null;
         $Shop_Product = null;
         $Shop_TaxClass = null;
         $Shop_Service = null;
         $Shop_ServiceMetafield = null;
         $Shop_ProductMetafield = null;
        // render code
         //
        $Shop_Category = new ObjectType([
            'name' => 'Shop_Category',
            'fields' => function () use (&$Shop_Category, &$CMS_Content, &$Shop_CategoryMetafield, &$Shop_Delivery, &$Shop_Product, &$Shop_Service){
                return [
                    // List of basic fields
                    
                    //id: Array(    [type] => Pluf_DB_Field_Sequence    [blank] =>     [editable] =>     [readable] => 1)
                    'id' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->id;
                        },
                    ],
                    //name: Array(    [type] => Pluf_DB_Field_Varchar    [blank] =>     [size] => 250    [editable] => 1    [readable] => 1)
                    'name' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->name;
                        },
                    ],
                    //creation_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [blank] => 1    [editable] =>     [readable] => 1)
                    'creation_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->creation_dtime;
                        },
                    ],
                    //modif_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [blank] => 1    [editable] =>     [readable] => 1)
                    'modif_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->modif_dtime;
                        },
                    ],
                    //description: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [size] => 250    [editable] => 1    [readable] => 1)
                    'description' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->description;
                        },
                    ],
                    //thumbnail: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [is_null] => 1    [size] => 512    [editable] => 1    [readable] => 1)
                    'thumbnail' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->thumbnail;
                        },
                    ],
                    //Foreinkey value-parent_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => Shop_Category    [blank] => 1    [name] => parent    [graphql_name] => parent    [relate_name] => children    [editable] => 1    [readable] => 1)
                    'parent_id' => [
                            'type' => Type::int(),
                            'resolve' => function ($root) {
                                return $root->parent_id;
                            },
                    ],
                    //Foreinkey object-parent_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => Shop_Category    [blank] => 1    [name] => parent    [graphql_name] => parent    [relate_name] => children    [editable] => 1    [readable] => 1)
                    'parent' => [
                            'type' => $Shop_Category,
                            'resolve' => function ($root) {
                                return $root->get_parent();
                            },
                    ],
                    //Foreinkey value-content_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => CMS_Content    [blank] => 1    [name] => content    [graphql_name] => content    [relate_name] => categories    [editable] => 1    [readable] => 1)
                    'content_id' => [
                            'type' => Type::int(),
                            'resolve' => function ($root) {
                                return $root->content_id;
                            },
                    ],
                    //Foreinkey object-content_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => CMS_Content    [blank] => 1    [name] => content    [graphql_name] => content    [relate_name] => categories    [editable] => 1    [readable] => 1)
                    'content' => [
                            'type' => $CMS_Content,
                            'resolve' => function ($root) {
                                return $root->get_content();
                            },
                    ],
                    // relations: forenkey
                    
                    //Foreinkey list-parent_id: Array()
                    'children' => [
                            'type' => Type::listOf($Shop_Category),
                            'resolve' => function ($root) {
                                return $root->get_children_list();
                            },
                    ],
                    //Foreinkey list-category_id: Array()
                    'metafields' => [
                            'type' => Type::listOf($Shop_CategoryMetafield),
                            'resolve' => function ($root) {
                                return $root->get_metafields_list();
                            },
                    ],
                    
                    //Foreinkey list-categories: Array()
                    'deliveries' => [
                            'type' => Type::listOf($Shop_Delivery),
                            'resolve' => function ($root) {
                                return $root->get_deliveries_list();
                            },
                    ],
                    //Foreinkey list-categories: Array()
                    'products' => [
                            'type' => Type::listOf($Shop_Product),
                            'resolve' => function ($root) {
                                return $root->get_products_list();
                            },
                    ],
                    //Foreinkey list-categories: Array()
                    'services' => [
                            'type' => Type::listOf($Shop_Service),
                            'resolve' => function ($root) {
                                return $root->get_services_list();
                            },
                    ],
                ];
            }
        ]); //
        $CMS_Content = new ObjectType([
            'name' => 'CMS_Content',
            'fields' => function () use (&$User_Account, &$CMS_Content, &$Shop_Agency){
                return [
                    // List of basic fields
                    
                    //id: Array(    [type] => Pluf_DB_Field_Sequence    [is_null] =>     [editable] => )
                    'id' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->id;
                        },
                    ],
                    //name: Array(    [type] => Pluf_DB_Field_Varchar    [is_null] =>     [size] => 64    [unique] => 1    [editable] => 1)
                    'name' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->name;
                        },
                    ],
                    //title: Array(    [type] => Pluf_DB_Field_Varchar    [is_null] => 1    [size] => 250    [default] =>     [editable] => 1)
                    'title' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->title;
                        },
                    ],
                    //description: Array(    [type] => Pluf_DB_Field_Varchar    [is_null] => 1    [size] => 2048    [default] => auto created content    [editable] => 1)
                    'description' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->description;
                        },
                    ],
                    //mime_type: Array(    [type] => Pluf_DB_Field_Varchar    [is_null] => 1    [size] => 64    [default] => application/octet-stream    [editable] => 1)
                    'mime_type' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->mime_type;
                        },
                    ],
                    //media_type: Array(    [type] => Pluf_DB_Field_Varchar    [is_null] => 1    [size] => 64    [default] => application/octet-stream    [verbose] => Media type    [help_text] => This types allow you to category contents    [editable] => 1)
                    'media_type' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->media_type;
                        },
                    ],
                    //file_name: Array(    [type] => Pluf_DB_Field_Varchar    [is_null] =>     [size] => 250    [default] => unknown    [verbose] => file name    [help_text] => Content file name    [editable] => 1)
                    'file_name' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->file_name;
                        },
                    ],
                    //file_size: Array(    [type] => Pluf_DB_Field_Integer    [is_null] =>     [default] => no title    [verbose] => file size    [help_text] => content file size    [editable] => )
                    'file_size' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->file_size;
                        },
                    ],
                    //downloads: Array(    [type] => Pluf_DB_Field_Integer    [is_null] =>     [default] => 0    [help_text] => content downloads number    [editable] => )
                    'downloads' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->downloads;
                        },
                    ],
                    //status: Array(    [type] => Pluf_DB_Field_Varchar    [is_null] => 1    [size] => 64    [default] => published    [editable] => )
                    'status' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->status;
                        },
                    ],
                    //comment_status: Array(    [type] => Pluf_DB_Field_Varchar    [is_null] => 1    [size] => 64    [default] =>     [editable] => )
                    'comment_status' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->comment_status;
                        },
                    ],
                    //comment_count: Array(    [type] => Pluf_DB_Field_Integer    [is_null] =>     [default] => 0    [help_text] => number of comments on the content    [editable] => )
                    'comment_count' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->comment_count;
                        },
                    ],
                    //creation_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [blank] => 1    [verbose] => creation    [help_text] => content creation time    [editable] => )
                    'creation_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->creation_dtime;
                        },
                    ],
                    //modif_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [blank] => 1    [verbose] => modification    [help_text] => content modification time    [editable] => )
                    'modif_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->modif_dtime;
                        },
                    ],
                    //Foreinkey value-author_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => User_Account    [is_null] =>     [name] => author    [relate_name] => cms_contents    [graphql_name] => author    [editable] => )
                    'author_id' => [
                            'type' => Type::int(),
                            'resolve' => function ($root) {
                                return $root->author_id;
                            },
                    ],
                    //Foreinkey object-author_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => User_Account    [is_null] =>     [name] => author    [relate_name] => cms_contents    [graphql_name] => author    [editable] => )
                    'author' => [
                            'type' => $User_Account,
                            'resolve' => function ($root) {
                                return $root->get_author();
                            },
                    ],
                    //Foreinkey value-parent_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => CMS_Content    [is_null] => 1    [name] => parent    [graphql_name] => parent    [relate_name] => children    [editable] => 1    [readable] => 1)
                    'parent_id' => [
                            'type' => Type::int(),
                            'resolve' => function ($root) {
                                return $root->parent_id;
                            },
                    ],
                    //Foreinkey object-parent_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => CMS_Content    [is_null] => 1    [name] => parent    [graphql_name] => parent    [relate_name] => children    [editable] => 1    [readable] => 1)
                    'parent' => [
                            'type' => $CMS_Content,
                            'resolve' => function ($root) {
                                return $root->get_parent();
                            },
                    ],
                    // relations: forenkey
                    
                    //Foreinkey list-content_id: Array()
                    'agencies' => [
                            'type' => Type::listOf($Shop_Agency),
                            'resolve' => function ($root) {
                                return $root->get_agencies_list();
                            },
                    ],
                    
                ];
            }
        ]); //
        $User_Account = new ObjectType([
            'name' => 'User_Account',
            'fields' => function () use (&$User_Group, &$User_Role, &$User_Message, &$User_Profile, &$User_Avatar, &$User_Verification, &$User_Email, &$User_Phone, &$User_Address, &$Tenant_Comment, &$Shop_Order, &$Shop_Zone, &$Shop_Address, &$Shop_Agency, &$Shop_Contact){
                return [
                    // List of basic fields
                    
                    //id: Array(    [type] => Pluf_DB_Field_Sequence    [is_null] => 1    [editable] =>     [readable] => 1)
                    'id' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->id;
                        },
                    ],
                    //login: Array(    [type] => Pluf_DB_Field_Varchar    [is_null] =>     [unique] => 1    [size] => 50    [editable] =>     [readable] => 1)
                    'login' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->login;
                        },
                    ],
                    //date_joined: Array(    [type] => Pluf_DB_Field_Datetime    [is_null] => 1    [editable] => )
                    'date_joined' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->date_joined;
                        },
                    ],
                    //last_login: Array(    [type] => Pluf_DB_Field_Datetime    [is_null] => 1    [editable] => )
                    'last_login' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->last_login;
                        },
                    ],
                    //is_active: Array(    [type] => Pluf_DB_Field_Boolean    [is_null] =>     [default] =>     [editable] => )
                    'is_active' => [
                        'type' => Type::boolean(),
                        'resolve' => function ($root) {
                            return $root->is_active;
                        },
                    ],
                    //is_deleted: Array(    [type] => Pluf_DB_Field_Boolean    [is_null] =>     [default] =>     [editable] => )
                    'is_deleted' => [
                        'type' => Type::boolean(),
                        'resolve' => function ($root) {
                            return $root->is_deleted;
                        },
                    ],
                    //Foreinkey value-groups: Array(    [type] => Pluf_DB_Field_Manytomany    [blank] => 1    [model] => User_Group    [relate_name] => accounts    [editable] =>     [graphql_name] => groups    [readable] => 1)
                    'groups' => [
                            'type' => Type::listOf($User_Group),
                            'resolve' => function ($root) {
                                return $root->get_groups_list();
                            },
                    ],
                    //Foreinkey value-roles: Array(    [type] => Pluf_DB_Field_Manytomany    [blank] => 1    [relate_name] => accounts    [editable] =>     [model] => User_Role    [graphql_name] => roles    [readable] => 1)
                    'roles' => [
                            'type' => Type::listOf($User_Role),
                            'resolve' => function ($root) {
                                return $root->get_roles_list();
                            },
                    ],
                    // relations: forenkey
                    
                    //Foreinkey list-account_id: Array()
                    'messages' => [
                            'type' => Type::listOf($User_Message),
                            'resolve' => function ($root) {
                                return $root->get_messages_list();
                            },
                    ],
                    //Foreinkey list-account_id: Array()
                    'profiles' => [
                            'type' => Type::listOf($User_Profile),
                            'resolve' => function ($root) {
                                return $root->get_profiles_list();
                            },
                    ],
                    //Foreinkey list-account_id: Array()
                    'avatars' => [
                            'type' => Type::listOf($User_Avatar),
                            'resolve' => function ($root) {
                                return $root->get_avatars_list();
                            },
                    ],
                    //Foreinkey list-account_id: Array()
                    'verifications' => [
                            'type' => Type::listOf($User_Verification),
                            'resolve' => function ($root) {
                                return $root->get_verifications_list();
                            },
                    ],
                    //Foreinkey list-account_id: Array()
                    'emails' => [
                            'type' => Type::listOf($User_Email),
                            'resolve' => function ($root) {
                                return $root->get_emails_list();
                            },
                    ],
                    //Foreinkey list-account_id: Array()
                    'phones' => [
                            'type' => Type::listOf($User_Phone),
                            'resolve' => function ($root) {
                                return $root->get_phones_list();
                            },
                    ],
                    //Foreinkey list-account_id: Array()
                    'addresses' => [
                            'type' => Type::listOf($User_Address),
                            'resolve' => function ($root) {
                                return $root->get_addresses_list();
                            },
                    ],
                    //Foreinkey list-author_id: Array()
                    'Tenant_Comment' => [
                            'type' => Type::listOf($Tenant_Comment),
                            'resolve' => function ($root) {
                                return $root->get_Tenant_Comment_list();
                            },
                    ],
                    //Foreinkey list-customer_id: Array()
                    'orders' => [
                            'type' => Type::listOf($Shop_Order),
                            'resolve' => function ($root) {
                                return $root->get_orders_list();
                            },
                    ],
                    //Foreinkey list-assignee_id: Array()
                    'orders' => [
                            'type' => Type::listOf($Shop_Order),
                            'resolve' => function ($root) {
                                return $root->get_orders_list();
                            },
                    ],
                    //Foreinkey list-owner_id: Array()
                    'owned_zones' => [
                            'type' => Type::listOf($Shop_Zone),
                            'resolve' => function ($root) {
                                return $root->get_owned_zones_list();
                            },
                    ],
                    
                    //Foreinkey list-owner_id: Array()
                    'agencies' => [
                            'type' => Type::listOf($Shop_Agency),
                            'resolve' => function ($root) {
                                return $root->get_agencies_list();
                            },
                    ],
                    //Foreinkey list-member: Array()
                    'zones' => [
                            'type' => Type::listOf($Shop_Zone),
                            'resolve' => function ($root) {
                                return $root->get_zones_list();
                            },
                    ],
                ];
            }
        ]); //
        $User_Group = new ObjectType([
            'name' => 'User_Group',
            'fields' => function () use (&$User_Role, &$User_Account){
                return [
                    // List of basic fields
                    
                    //id: Array(    [type] => Pluf_DB_Field_Sequence    [blank] => 1    [readable] => 1    [editable] => )
                    'id' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->id;
                        },
                    ],
                    //name: Array(    [type] => Pluf_DB_Field_Varchar    [is_null] =>     [size] => 50    [verbose] => name)
                    'name' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->name;
                        },
                    ],
                    //description: Array(    [type] => Pluf_DB_Field_Varchar    [is_null] => 1    [size] => 250    [verbose] => description)
                    'description' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->description;
                        },
                    ],
                    //Foreinkey value-roles: Array(    [type] => Pluf_DB_Field_Manytomany    [model] => User_Role    [is_null] => 1    [editable] =>     [relate_name] => groups    [graphql_name] => roles)
                    'roles' => [
                            'type' => Type::listOf($User_Role),
                            'resolve' => function ($root) {
                                return $root->get_roles_list();
                            },
                    ],
                    // relations: forenkey
                    
                    
                    //Foreinkey list-groups: Array()
                    'accounts' => [
                            'type' => Type::listOf($User_Account),
                            'resolve' => function ($root) {
                                return $root->get_accounts_list();
                            },
                    ],
                ];
            }
        ]); //
        $User_Role = new ObjectType([
            'name' => 'User_Role',
            'fields' => function () use (&$User_Account, &$User_Group){
                return [
                    // List of basic fields
                    
                    //id: Array(    [type] => Pluf_DB_Field_Sequence    [blank] => 1    [editable] =>     [readable] => 1)
                    'id' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->id;
                        },
                    ],
                    //name: Array(    [type] => Pluf_DB_Field_Varchar    [is_null] =>     [size] => 50    [verbose] => name)
                    'name' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->name;
                        },
                    ],
                    //description: Array(    [type] => Pluf_DB_Field_Varchar    [is_null] => 1    [size] => 250    [verbose] => description)
                    'description' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->description;
                        },
                    ],
                    //application: Array(    [type] => Pluf_DB_Field_Varchar    [size] => 150    [is_null] =>     [verbose] => application    [help_text] => The application using this permission, for example "YourApp", "CMS" or "SView".)
                    'application' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->application;
                        },
                    ],
                    //code_name: Array(    [type] => Pluf_DB_Field_Varchar    [is_null] =>     [size] => 100    [verbose] => code name    [help_text] => The code name must be unique for each application. Standard permissions to manage a model in the interface are "Model_Name-create", "Model_Name-update", "Model_Name-list" and "Model_Name-delete".)
                    'code_name' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->code_name;
                        },
                    ],
                    // relations: forenkey
                    
                    
                    //Foreinkey list-roles: Array()
                    'accounts' => [
                            'type' => Type::listOf($User_Account),
                            'resolve' => function ($root) {
                                return $root->get_accounts_list();
                            },
                    ],
                    //Foreinkey list-roles: Array()
                    'groups' => [
                            'type' => Type::listOf($User_Group),
                            'resolve' => function ($root) {
                                return $root->get_groups_list();
                            },
                    ],
                ];
            }
        ]); //
        $User_Message = new ObjectType([
            'name' => 'User_Message',
            'fields' => function () use (&$User_Account){
                return [
                    // List of basic fields
                    
                    //id: Array(    [type] => Pluf_DB_Field_Sequence    [blank] => 1    [editable] =>     [readable] => 1)
                    'id' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->id;
                        },
                    ],
                    //Foreinkey value-account_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => User_Account    [name] => account    [graphql_name] => account    [relate_name] => messages    [is_null] =>     [editable] => )
                    'account_id' => [
                            'type' => Type::int(),
                            'resolve' => function ($root) {
                                return $root->account_id;
                            },
                    ],
                    //Foreinkey object-account_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => User_Account    [name] => account    [graphql_name] => account    [relate_name] => messages    [is_null] =>     [editable] => )
                    'account' => [
                            'type' => $User_Account,
                            'resolve' => function ($root) {
                                return $root->get_account();
                            },
                    ],
                    //message: Array(    [type] => Pluf_DB_Field_Text    [is_null] =>     [editable] =>     [readable] => 1)
                    'message' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->message;
                        },
                    ],
                    //creation_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [is_null] => 1    [editable] =>     [readable] => 1)
                    'creation_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->creation_dtime;
                        },
                    ],
                    // relations: forenkey
                    
                    
                ];
            }
        ]); //
        $User_Profile = new ObjectType([
            'name' => 'User_Profile',
            'fields' => function () use (&$User_Account){
                return [
                    // List of basic fields
                    
                    //id: Array(    [type] => Pluf_DB_Field_Sequence    [is_null] => 1    [editable] =>     [readable] => 1)
                    'id' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->id;
                        },
                    ],
                    //first_name: Array(    [type] => Pluf_DB_Field_Varchar    [is_null] => 1    [size] => 100    [editable] => 1)
                    'first_name' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->first_name;
                        },
                    ],
                    //last_name: Array(    [type] => Pluf_DB_Field_Varchar    [is_null] =>     [size] => 100    [editable] => 1)
                    'last_name' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->last_name;
                        },
                    ],
                    //public_email: Array(    [type] => Pluf_DB_Field_Email    [is_null] => 1    [editable] => 1    [readable] => 1)
                    'public_email' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->public_email;
                        },
                    ],
                    //language: Array(    [type] => Pluf_DB_Field_Varchar    [is_null] => 1    [default] => en    [size] => 5    [editable] => 1)
                    'language' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->language;
                        },
                    ],
                    //timezone: Array(    [type] => Pluf_DB_Field_Varchar    [is_null] => 1    [default] => UTC    [size] => 45    [verbose] => time zone    [help_text] => Time zone of the user to display the time in local time.    [editable] => 1)
                    'timezone' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->timezone;
                        },
                    ],
                    //national_code: Array(    [type] => Pluf_DB_Field_Varchar    [is_null] => 1    [size] => 32    [editable] => 1)
                    'national_code' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->national_code;
                        },
                    ],
                    //gender: Array(    [type] => Pluf_DB_Field_Varchar    [is_null] => 1    [size] => 16    [editable] => 1)
                    'gender' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->gender;
                        },
                    ],
                    //weight: Array(    [type] => Pluf_DB_Field_Float    [is_null] => 1    [editable] => 1)
                    'weight' => [
                        'type' => Type::float(),
                        'resolve' => function ($root) {
                            return $root->weight;
                        },
                    ],
                    //birthday: Array(    [type] => Pluf_DB_Field_Date    [default] => 0000-00-00    [is_null] => 1    [editable] => 1)
                    'birthday' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->birthday;
                        },
                    ],
                    //Foreinkey value-account_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => User_Account    [name] => account    [relate_name] => profiles    [graphql_name] => account    [is_null] =>     [editable] => )
                    'account_id' => [
                            'type' => Type::int(),
                            'resolve' => function ($root) {
                                return $root->account_id;
                            },
                    ],
                    //Foreinkey object-account_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => User_Account    [name] => account    [relate_name] => profiles    [graphql_name] => account    [is_null] =>     [editable] => )
                    'account' => [
                            'type' => $User_Account,
                            'resolve' => function ($root) {
                                return $root->get_account();
                            },
                    ],
                    // relations: forenkey
                    
                    
                ];
            }
        ]); //
        $User_Avatar = new ObjectType([
            'name' => 'User_Avatar',
            'fields' => function () use (&$User_Account){
                return [
                    // List of basic fields
                    
                    //id: Array(    [type] => Pluf_DB_Field_Sequence    [blank] => 1    [editable] => )
                    'id' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->id;
                        },
                    ],
                    //fileName: Array(    [type] => Pluf_DB_Field_Varchar    [is_null] =>     [unique] =>     [editable] => )
                    'fileName' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->fileName;
                        },
                    ],
                    //filePath: Array(    [type] => Pluf_DB_Field_Varchar    [is_null] =>     [unique] =>     [editable] => )
                    'filePath' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->filePath;
                        },
                    ],
                    //fileSize: Array(    [type] => Pluf_DB_Field_Integer    [is_null] =>     [verbose] => validate    [editable] => )
                    'fileSize' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->fileSize;
                        },
                    ],
                    //mimeType: Array(    [type] => Pluf_DB_Field_Varchar    [is_null] =>     [size] => 50    [editable] => )
                    'mimeType' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->mimeType;
                        },
                    ],
                    //creationTime: Array(    [type] => Pluf_DB_Field_Datetime    [is_null] =>     [editable] => )
                    'creationTime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->creationTime;
                        },
                    ],
                    //modifTime: Array(    [type] => Pluf_DB_Field_Datetime    [is_null] =>     [editable] => )
                    'modifTime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->modifTime;
                        },
                    ],
                    //Foreinkey value-account_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => User_Account    [unique] => 1    [name] => account    [relate_name] => avatars    [graphql_name] => account    [is_null] =>     [editable] => )
                    'account_id' => [
                            'type' => Type::int(),
                            'resolve' => function ($root) {
                                return $root->account_id;
                            },
                    ],
                    //Foreinkey object-account_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => User_Account    [unique] => 1    [name] => account    [relate_name] => avatars    [graphql_name] => account    [is_null] =>     [editable] => )
                    'account' => [
                            'type' => $User_Account,
                            'resolve' => function ($root) {
                                return $root->get_account();
                            },
                    ],
                    // relations: forenkey
                    
                    
                ];
            }
        ]); //
        $User_Verification = new ObjectType([
            'name' => 'User_Verification',
            'fields' => function () use (&$User_Account){
                return [
                    // List of basic fields
                    
                    //id: Array(    [type] => Pluf_DB_Field_Sequence    [is_null] => 1    [editable] =>     [readable] => 1)
                    'id' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->id;
                        },
                    ],
                    //expiry_count: Array(    [type] => Pluf_DB_Field_Integer    [editable] => )
                    'expiry_count' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->expiry_count;
                        },
                    ],
                    //expiry_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [editable] => )
                    'expiry_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->expiry_dtime;
                        },
                    ],
                    //creation_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [is_null] =>     [editable] => )
                    'creation_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->creation_dtime;
                        },
                    ],
                    //Foreinkey value-account_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => User_Account    [name] => account    [relate_name] => verifications    [graphql_name] => account    [is_null] =>     [editable] => )
                    'account_id' => [
                            'type' => Type::int(),
                            'resolve' => function ($root) {
                                return $root->account_id;
                            },
                    ],
                    //Foreinkey object-account_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => User_Account    [name] => account    [relate_name] => verifications    [graphql_name] => account    [is_null] =>     [editable] => )
                    'account' => [
                            'type' => $User_Account,
                            'resolve' => function ($root) {
                                return $root->get_account();
                            },
                    ],
                    // relations: forenkey
                    
                    
                ];
            }
        ]); //
        $User_Email = new ObjectType([
            'name' => 'User_Email',
            'fields' => function () use (&$User_Account){
                return [
                    // List of basic fields
                    
                    //id: Array(    [type] => Pluf_DB_Field_Sequence    [is_null] => 1    [editable] =>     [readable] => 1)
                    'id' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->id;
                        },
                    ],
                    //email: Array(    [type] => Pluf_DB_Field_Varchar    [is_null] =>     [size] => 128    [editable] =>     [readable] => 1)
                    'email' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->email;
                        },
                    ],
                    //type: Array(    [type] => Pluf_DB_Field_Varchar    [is_null] => 1    [size] => 64    [editable] => 1    [readable] => 1)
                    'type' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->type;
                        },
                    ],
                    //is_verified: Array(    [type] => Pluf_DB_Field_Boolean    [is_null] =>     [editable] =>     [readable] => 1)
                    'is_verified' => [
                        'type' => Type::boolean(),
                        'resolve' => function ($root) {
                            return $root->is_verified;
                        },
                    ],
                    //Foreinkey value-account_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => User_Account    [name] => account    [relate_name] => emails    [graphql_name] => account    [is_null] =>     [editable] => )
                    'account_id' => [
                            'type' => Type::int(),
                            'resolve' => function ($root) {
                                return $root->account_id;
                            },
                    ],
                    //Foreinkey object-account_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => User_Account    [name] => account    [relate_name] => emails    [graphql_name] => account    [is_null] =>     [editable] => )
                    'account' => [
                            'type' => $User_Account,
                            'resolve' => function ($root) {
                                return $root->get_account();
                            },
                    ],
                    // relations: forenkey
                    
                    
                ];
            }
        ]); //
        $User_Phone = new ObjectType([
            'name' => 'User_Phone',
            'fields' => function () use (&$User_Account){
                return [
                    // List of basic fields
                    
                    //id: Array(    [type] => Pluf_DB_Field_Sequence    [is_null] => 1    [editable] =>     [readable] => 1)
                    'id' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->id;
                        },
                    ],
                    //phone: Array(    [type] => Pluf_DB_Field_Varchar    [is_null] =>     [size] => 32    [editable] =>     [readable] => 1)
                    'phone' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->phone;
                        },
                    ],
                    //type: Array(    [type] => Pluf_DB_Field_Varchar    [is_null] => 1    [size] => 64    [editable] => 1    [readable] => 1)
                    'type' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->type;
                        },
                    ],
                    //is_verified: Array(    [type] => Pluf_DB_Field_Boolean    [is_null] =>     [editable] =>     [readable] => 1)
                    'is_verified' => [
                        'type' => Type::boolean(),
                        'resolve' => function ($root) {
                            return $root->is_verified;
                        },
                    ],
                    //Foreinkey value-account_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => User_Account    [name] => account    [relate_name] => phones    [graphql_name] => account    [is_null] =>     [editable] => )
                    'account_id' => [
                            'type' => Type::int(),
                            'resolve' => function ($root) {
                                return $root->account_id;
                            },
                    ],
                    //Foreinkey object-account_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => User_Account    [name] => account    [relate_name] => phones    [graphql_name] => account    [is_null] =>     [editable] => )
                    'account' => [
                            'type' => $User_Account,
                            'resolve' => function ($root) {
                                return $root->get_account();
                            },
                    ],
                    // relations: forenkey
                    
                    
                ];
            }
        ]); //
        $User_Address = new ObjectType([
            'name' => 'User_Address',
            'fields' => function () use (&$User_Account){
                return [
                    // List of basic fields
                    
                    //id: Array(    [type] => Pluf_DB_Field_Sequence    [is_null] => 1    [editable] => )
                    'id' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->id;
                        },
                    ],
                    //country: Array(    [type] => Pluf_DB_Field_Varchar    [size] => 64    [is_null] => 1    [editable] => 1    [readable] => 1)
                    'country' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->country;
                        },
                    ],
                    //province: Array(    [type] => Pluf_DB_Field_Varchar    [size] => 64    [is_null] => 1    [editable] => 1    [readable] => 1)
                    'province' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->province;
                        },
                    ],
                    //city: Array(    [type] => Pluf_DB_Field_Varchar    [size] => 64    [is_null] => 1    [editable] => 1    [readable] => 1)
                    'city' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->city;
                        },
                    ],
                    //address: Array(    [type] => Pluf_DB_Field_Varchar    [size] => 512    [is_null] => 1    [editable] => 1    [readable] => 1)
                    'address' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->address;
                        },
                    ],
                    //postal_code: Array(    [type] => Pluf_DB_Field_Varchar    [size] => 16    [is_null] => 1    [editable] => 1    [readable] => 1)
                    'postal_code' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->postal_code;
                        },
                    ],
                    //location: Array(    [type] => Pluf_DB_Field_Geometry    [is_null] => 1    [editable] => 1    [readable] => 1)
                    'location' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->location;
                        },
                    ],
                    //type: Array(    [type] => Pluf_DB_Field_Varchar    [is_null] => 1    [size] => 64    [editable] => 1    [readable] => 1)
                    'type' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->type;
                        },
                    ],
                    //is_verified: Array(    [type] => Pluf_DB_Field_Boolean    [is_null] =>     [editable] =>     [readable] => 1)
                    'is_verified' => [
                        'type' => Type::boolean(),
                        'resolve' => function ($root) {
                            return $root->is_verified;
                        },
                    ],
                    //Foreinkey value-account_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => User_Account    [name] => account    [relate_name] => addresses    [graphql_name] => account    [is_null] =>     [editable] => )
                    'account_id' => [
                            'type' => Type::int(),
                            'resolve' => function ($root) {
                                return $root->account_id;
                            },
                    ],
                    //Foreinkey object-account_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => User_Account    [name] => account    [relate_name] => addresses    [graphql_name] => account    [is_null] =>     [editable] => )
                    'account' => [
                            'type' => $User_Account,
                            'resolve' => function ($root) {
                                return $root->get_account();
                            },
                    ],
                    // relations: forenkey
                    
                    
                ];
            }
        ]); //
        $Tenant_Comment = new ObjectType([
            'name' => 'Tenant_Comment',
            'fields' => function () use (&$User_Account, &$Tenant_Ticket){
                return [
                    // List of basic fields
                    
                    //id: Array(    [type] => Pluf_DB_Field_Sequence    [blank] =>     [editable] =>     [readable] => 1)
                    'id' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->id;
                        },
                    ],
                    //title: Array(    [type] => Pluf_DB_Field_Varchar    [blank] =>     [is_null] =>     [size] => 256)
                    'title' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->title;
                        },
                    ],
                    //description: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [is_null] => 1    [size] => 2048)
                    'description' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->description;
                        },
                    ],
                    //creation_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [blank] => 1    [is_null] => 1    [editable] =>     [readable] => 1)
                    'creation_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->creation_dtime;
                        },
                    ],
                    //modif_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [blank] => 1    [is_null] => 1    [editable] =>     [readable] => 1)
                    'modif_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->modif_dtime;
                        },
                    ],
                    //Foreinkey value-author_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => User_Account    [is_null] =>     [editable] =>     [readable] => 1    [name] => author    [graphql_feild] => author)
                    'author_id' => [
                            'type' => Type::int(),
                            'resolve' => function ($root) {
                                return $root->author_id;
                            },
                    ],
                    //Foreinkey value-ticket_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => Tenant_Ticket    [is_null] =>     [editable] =>     [readable] => 1    [name] => ticket    [graphql_feild] => ticket)
                    'ticket_id' => [
                            'type' => Type::int(),
                            'resolve' => function ($root) {
                                return $root->ticket_id;
                            },
                    ],
                    // relations: forenkey
                    
                    
                ];
            }
        ]); //
        $Tenant_Ticket = new ObjectType([
            'name' => 'Tenant_Ticket',
            'fields' => function () use (&$User_Account){
                return [
                    // List of basic fields
                    
                    //id: Array(    [type] => Pluf_DB_Field_Sequence    [blank] =>     [editable] =>     [readable] => 1)
                    'id' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->id;
                        },
                    ],
                    //type: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [is_null] => 1    [size] => 256)
                    'type' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->type;
                        },
                    ],
                    //subject: Array(    [type] => Pluf_DB_Field_Varchar    [blank] =>     [is_null] =>     [size] => 256)
                    'subject' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->subject;
                        },
                    ],
                    //description: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [is_null] => 1    [size] => 2048)
                    'description' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->description;
                        },
                    ],
                    //status: Array(    [type] => Pluf_DB_Field_Varchar    [blank] =>     [is_null] =>     [size] => 50    [editable] =>     [readable] => 1)
                    'status' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->status;
                        },
                    ],
                    //creation_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [blank] => 1    [is_null] => 1    [editable] =>     [readable] => 1)
                    'creation_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->creation_dtime;
                        },
                    ],
                    //modif_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [blank] => 1    [is_null] => 1    [editable] =>     [readable] => 1)
                    'modif_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->modif_dtime;
                        },
                    ],
                    //Foreinkey value-requester_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => User_Account    [blank] =>     [editable] =>     [readable] => 1    [name] => requester    [graphql_name] => requester)
                    'requester_id' => [
                            'type' => Type::int(),
                            'resolve' => function ($root) {
                                return $root->requester_id;
                            },
                    ],
                    //Foreinkey object-requester_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => User_Account    [blank] =>     [editable] =>     [readable] => 1    [name] => requester    [graphql_name] => requester)
                    'requester' => [
                            'type' => $User_Account,
                            'resolve' => function ($root) {
                                return $root->get_requester();
                            },
                    ],
                    // relations: forenkey
                    
                    
                ];
            }
        ]); //
        $Shop_Order = new ObjectType([
            'name' => 'Shop_Order',
            'fields' => function () use (&$User_Account, &$Bank_Receipt, &$Shop_Zone, &$Shop_Agency, &$Shop_OrderMetafield, &$Shop_OrderItem, &$Shop_OrderHistory, &$Shop_OrderAttachment){
                return [
                    // List of basic fields
                    
                    //id: Array(    [type] => Pluf_DB_Field_Sequence    [is_null] =>     [editable] =>     [readable] => 1)
                    'id' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->id;
                        },
                    ],
                    //title: Array(    [type] => Pluf_DB_Field_Varchar    [blank] =>     [is_null] =>     [size] => 250    [editable] => 1    [readable] => 1)
                    'title' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->title;
                        },
                    ],
                    //full_name: Array(    [type] => Pluf_DB_Field_Varchar    [blank] =>     [size] => 50    [readable] => 1    [editable] => 1)
                    'full_name' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->full_name;
                        },
                    ],
                    //phone: Array(    [type] => Pluf_DB_Field_Varchar    [blank] =>     [size] => 30    [readable] => 1    [editable] => 1)
                    'phone' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->phone;
                        },
                    ],
                    //email: Array(    [type] => Pluf_DB_Field_Email    [blank] => 1    [readable] => 1    [editable] => 1)
                    'email' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->email;
                        },
                    ],
                    //province: Array(    [type] => Pluf_DB_Field_Varchar    [size] => 100    [is_null] => 1    [editable] => 1    [readable] => 1)
                    'province' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->province;
                        },
                    ],
                    //city: Array(    [type] => Pluf_DB_Field_Varchar    [size] => 100    [is_null] => 1    [editable] => 1    [readable] => 1)
                    'city' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->city;
                        },
                    ],
                    //address: Array(    [type] => Pluf_DB_Field_Varchar    [size] => 500    [is_null] => 1    [editable] => 1    [readable] => 1)
                    'address' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->address;
                        },
                    ],
                    //point: Array(    [type] => Pluf_DB_Field_Geometry    [is_null] => 1    [editable] => 1    [readable] => 1)
                    'point' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->point;
                        },
                    ],
                    //description: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [size] => 250    [editable] => 1    [readable] => 1)
                    'description' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->description;
                        },
                    ],
                    //manager: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [size] => 100    [editable] =>     [readable] => 1)
                    'manager' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->manager;
                        },
                    ],
                    //state: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [size] => 50    [editable] => 1    [readable] => 1)
                    'state' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->state;
                        },
                    ],
                    //deleted: Array(    [type] => Pluf_DB_Field_Boolean    [blank] =>     [default] =>     [readable] => 1    [editable] => )
                    'deleted' => [
                        'type' => Type::boolean(),
                        'resolve' => function ($root) {
                            return $root->deleted;
                        },
                    ],
                    //creation_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [blank] => 1    [editable] =>     [readable] => 1)
                    'creation_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->creation_dtime;
                        },
                    ],
                    //modif_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [blank] => 1    [editable] =>     [readable] => 1)
                    'modif_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->modif_dtime;
                        },
                    ],
                    //Foreinkey value-customer_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => User_Account    [name] => customer    [graphql_name] => customer    [relate_name] => orders    [is_null] => 1    [editable] =>     [readable] => 1)
                    'customer_id' => [
                            'type' => Type::int(),
                            'resolve' => function ($root) {
                                return $root->customer_id;
                            },
                    ],
                    //Foreinkey object-customer_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => User_Account    [name] => customer    [graphql_name] => customer    [relate_name] => orders    [is_null] => 1    [editable] =>     [readable] => 1)
                    'customer' => [
                            'type' => $User_Account,
                            'resolve' => function ($root) {
                                return $root->get_customer();
                            },
                    ],
                    //Foreinkey value-assignee_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => User_Account    [name] => assignee    [graphql_name] => assignee    [relate_name] => orders    [is_null] => 1    [editable] =>     [readable] => 1)
                    'assignee_id' => [
                            'type' => Type::int(),
                            'resolve' => function ($root) {
                                return $root->assignee_id;
                            },
                    ],
                    //Foreinkey object-assignee_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => User_Account    [name] => assignee    [graphql_name] => assignee    [relate_name] => orders    [is_null] => 1    [editable] =>     [readable] => 1)
                    'assignee' => [
                            'type' => $User_Account,
                            'resolve' => function ($root) {
                                return $root->get_assignee();
                            },
                    ],
                    //Foreinkey value-payment_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => Bank_Receipt    [name] => payment    [graphql_name] => payment    [relate_name] => orders    [is_null] => 1    [editable] =>     [readable] => 1)
                    'payment_id' => [
                            'type' => Type::int(),
                            'resolve' => function ($root) {
                                return $root->payment_id;
                            },
                    ],
                    //Foreinkey object-payment_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => Bank_Receipt    [name] => payment    [graphql_name] => payment    [relate_name] => orders    [is_null] => 1    [editable] =>     [readable] => 1)
                    'payment' => [
                            'type' => $Bank_Receipt,
                            'resolve' => function ($root) {
                                return $root->get_payment();
                            },
                    ],
                    //Foreinkey value-zone_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => Shop_Zone    [name] => zone    [graphql_name] => zone    [relate_name] => orders    [is_null] => 1    [editable] =>     [readable] => 1)
                    'zone_id' => [
                            'type' => Type::int(),
                            'resolve' => function ($root) {
                                return $root->zone_id;
                            },
                    ],
                    //Foreinkey object-zone_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => Shop_Zone    [name] => zone    [graphql_name] => zone    [relate_name] => orders    [is_null] => 1    [editable] =>     [readable] => 1)
                    'zone' => [
                            'type' => $Shop_Zone,
                            'resolve' => function ($root) {
                                return $root->get_zone();
                            },
                    ],
                    //Foreinkey value-agency_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => Shop_Agency    [name] => agency    [graphql_name] => agency    [relate_name] => orders    [is_null] => 1    [editable] =>     [readable] => 1)
                    'agency_id' => [
                            'type' => Type::int(),
                            'resolve' => function ($root) {
                                return $root->agency_id;
                            },
                    ],
                    //Foreinkey object-agency_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => Shop_Agency    [name] => agency    [graphql_name] => agency    [relate_name] => orders    [is_null] => 1    [editable] =>     [readable] => 1)
                    'agency' => [
                            'type' => $Shop_Agency,
                            'resolve' => function ($root) {
                                return $root->get_agency();
                            },
                    ],
                    // relations: forenkey
                    
                    //Foreinkey list-order_id: Array()
                    'metafields' => [
                            'type' => Type::listOf($Shop_OrderMetafield),
                            'resolve' => function ($root) {
                                return $root->get_metafields_list();
                            },
                    ],
                    //Foreinkey list-order_id: Array()
                    'order_items' => [
                            'type' => Type::listOf($Shop_OrderItem),
                            'resolve' => function ($root) {
                                return $root->get_order_items_list();
                            },
                    ],
                    //Foreinkey list-order_id: Array()
                    'histories' => [
                            'type' => Type::listOf($Shop_OrderHistory),
                            'resolve' => function ($root) {
                                return $root->get_histories_list();
                            },
                    ],
                    //Foreinkey list-order_id: Array()
                    'attachments' => [
                            'type' => Type::listOf($Shop_OrderAttachment),
                            'resolve' => function ($root) {
                                return $root->get_attachments_list();
                            },
                    ],
                    
                ];
            }
        ]); //
        $Bank_Receipt = new ObjectType([
            'name' => 'Bank_Receipt',
            'fields' => function () use (&$Bank_Backend, &$Tenant_Invoice, &$Shop_Order){
                return [
                    // List of basic fields
                    
                    //id: Array(    [type] => Pluf_DB_Field_Sequence    [blank] => 1    [editable] =>     [readable] => 1)
                    'id' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->id;
                        },
                    ],
                    //amount: Array(    [type] => Pluf_DB_Field_Integer    [blank] =>     [unique] => )
                    'amount' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->amount;
                        },
                    ],
                    //title: Array(    [type] => Pluf_DB_Field_Varchar    [blank] =>     [size] => 50)
                    'title' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->title;
                        },
                    ],
                    //description: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [size] => 200)
                    'description' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->description;
                        },
                    ],
                    //email: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [size] => 100)
                    'email' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->email;
                        },
                    ],
                    //phone: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [size] => 100)
                    'phone' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->phone;
                        },
                    ],
                    //callbackURL: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [size] => 200)
                    'callbackURL' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->callbackURL;
                        },
                    ],
                    //payRef: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [size] => 200    [readable] => 1)
                    'payRef' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->payRef;
                        },
                    ],
                    //callURL: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [size] => 200    [readable] => 1)
                    'callURL' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->callURL;
                        },
                    ],
                    //owner_id: Array(    [type] => Pluf_DB_Field_Integer    [blank] =>     [verbose] => owner ID)
                    'owner_id' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->owner_id;
                        },
                    ],
                    //owner_class: Array(    [type] => Pluf_DB_Field_Varchar    [blank] =>     [size] => 50)
                    'owner_class' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->owner_class;
                        },
                    ],
                    //creation_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [blank] => 1    [verbose] => creation date)
                    'creation_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->creation_dtime;
                        },
                    ],
                    //modif_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [blank] => 1    [verbose] => modification date)
                    'modif_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->modif_dtime;
                        },
                    ],
                    //Foreinkey value-backend_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => Bank_Backend    [blank] =>     [is_null] =>     [name] => backend    [graphql_name] => backend    [relate_name] => receipts)
                    'backend_id' => [
                            'type' => Type::int(),
                            'resolve' => function ($root) {
                                return $root->backend_id;
                            },
                    ],
                    //Foreinkey object-backend_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => Bank_Backend    [blank] =>     [is_null] =>     [name] => backend    [graphql_name] => backend    [relate_name] => receipts)
                    'backend' => [
                            'type' => $Bank_Backend,
                            'resolve' => function ($root) {
                                return $root->get_backend();
                            },
                    ],
                    // relations: forenkey
                    
                    //Foreinkey list-payment_id: Array()
                    'orders' => [
                            'type' => Type::listOf($Shop_Order),
                            'resolve' => function ($root) {
                                return $root->get_orders_list();
                            },
                    ],
                    
                ];
            }
        ]); //
        $Bank_Backend = new ObjectType([
            'name' => 'Bank_Backend',
            'fields' => function () {
                return [
                    // List of basic fields
                    
                    //id: Array(    [type] => Pluf_DB_Field_Sequence    [blank] => 1    [verbose] => unique and no repreducable id fro reception)
                    'id' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->id;
                        },
                    ],
                    //title: Array(    [type] => Pluf_DB_Field_Varchar    [blank] =>     [size] => 50)
                    'title' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->title;
                        },
                    ],
                    //description: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [size] => 200)
                    'description' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->description;
                        },
                    ],
                    //symbol: Array(    [type] => Pluf_DB_Field_Varchar    [blank] =>     [size] => 50)
                    'symbol' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->symbol;
                        },
                    ],
                    //home: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [size] => 50)
                    'home' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->home;
                        },
                    ],
                    //redirect: Array(    [type] => Pluf_DB_Field_Varchar    [blank] =>     [size] => 50    [secure] => 1)
                    'redirect' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->redirect;
                        },
                    ],
                    //engine: Array(    [type] => Pluf_DB_Field_Varchar    [blank] =>     [size] => 50)
                    'engine' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->engine;
                        },
                    ],
                    //currency: Array(    [type] => Pluf_DB_Field_Varchar    [blank] =>     [is_null] =>     [size] => 50    [editable] =>     [readable] => 1)
                    'currency' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->currency;
                        },
                    ],
                    //deleted: Array(    [type] => Pluf_DB_Field_Boolean    [blank] =>     [default] =>     [readable] => 1    [editable] => )
                    'deleted' => [
                        'type' => Type::boolean(),
                        'resolve' => function ($root) {
                            return $root->deleted;
                        },
                    ],
                    //creation_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [blank] => 1    [verbose] => creation date)
                    'creation_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->creation_dtime;
                        },
                    ],
                    //modif_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [blank] => 1    [verbose] => modification date)
                    'modif_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->modif_dtime;
                        },
                    ],
                    // relations: forenkey
                    
                    
                ];
            }
        ]); //
        $Tenant_Invoice = new ObjectType([
            'name' => 'Tenant_Invoice',
            'fields' => function () use (&$Tenant_BankReceipt){
                return [
                    // List of basic fields
                    
                    //id: Array(    [type] => Pluf_DB_Field_Sequence    [blank] =>     [editable] =>     [readable] => 1)
                    'id' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->id;
                        },
                    ],
                    //title: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [is_null] => 1    [size] => 256    [editable] => 1    [readable] => 1)
                    'title' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->title;
                        },
                    ],
                    //description: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [is_null] => 1    [size] => 500    [editable] => 1    [readable] => 1)
                    'description' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->description;
                        },
                    ],
                    //amount: Array(    [type] => Pluf_DB_Field_Integer    [blank] =>     [is_null] => )
                    'amount' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->amount;
                        },
                    ],
                    //due_dtime: Array(    [type] => Pluf_DB_Field_Date    [blank] =>     [is_null] =>     [editable] => 1    [readable] => 1)
                    'due_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->due_dtime;
                        },
                    ],
                    //status: Array(    [type] => Pluf_DB_Field_Varchar    [blank] =>     [is_null] =>     [size] => 50    [editable] =>     [readable] => 1)
                    'status' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->status;
                        },
                    ],
                    //discount_code: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [is_null] => 1    [size] => 50    [editable] =>     [readable] => 1)
                    'discount_code' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->discount_code;
                        },
                    ],
                    //creation_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [blank] => 1    [is_null] => 1    [editable] =>     [readable] => 1)
                    'creation_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->creation_dtime;
                        },
                    ],
                    //modif_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [blank] => 1    [is_null] => 1    [editable] =>     [readable] => 1)
                    'modif_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->modif_dtime;
                        },
                    ],
                    //Foreinkey value-payment_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => Tenant_BankReceipt    [blank] =>     [editable] =>     [readable] => 1    [name] => payment    [graphql_name] => payment)
                    'payment_id' => [
                            'type' => Type::int(),
                            'resolve' => function ($root) {
                                return $root->payment_id;
                            },
                    ],
                    //Foreinkey object-payment_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => Tenant_BankReceipt    [blank] =>     [editable] =>     [readable] => 1    [name] => payment    [graphql_name] => payment)
                    'payment' => [
                            'type' => $Tenant_BankReceipt,
                            'resolve' => function ($root) {
                                return $root->get_payment();
                            },
                    ],
                    // relations: forenkey
                    
                    
                ];
            }
        ]); //
        $Tenant_BankReceipt = new ObjectType([
            'name' => 'Tenant_BankReceipt',
            'fields' => function () use (&$Tenant_BankBackend){
                return [
                    // List of basic fields
                    
                    //id: Array(    [type] => Pluf_DB_Field_Sequence    [blank] => 1    [editable] =>     [readable] => 1)
                    'id' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->id;
                        },
                    ],
                    //amount: Array(    [type] => Pluf_DB_Field_Integer    [blank] =>     [unique] => )
                    'amount' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->amount;
                        },
                    ],
                    //title: Array(    [type] => Pluf_DB_Field_Varchar    [blank] =>     [size] => 50)
                    'title' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->title;
                        },
                    ],
                    //description: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [size] => 200)
                    'description' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->description;
                        },
                    ],
                    //email: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [size] => 100)
                    'email' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->email;
                        },
                    ],
                    //phone: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [size] => 100)
                    'phone' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->phone;
                        },
                    ],
                    //callbackURL: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [size] => 200)
                    'callbackURL' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->callbackURL;
                        },
                    ],
                    //payRef: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [size] => 200    [readable] => 1)
                    'payRef' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->payRef;
                        },
                    ],
                    //callURL: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [size] => 200    [readable] => 1)
                    'callURL' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->callURL;
                        },
                    ],
                    //owner_id: Array(    [type] => Pluf_DB_Field_Integer    [blank] =>     [verbose] => owner ID)
                    'owner_id' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->owner_id;
                        },
                    ],
                    //owner_class: Array(    [type] => Pluf_DB_Field_Varchar    [blank] =>     [size] => 50)
                    'owner_class' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->owner_class;
                        },
                    ],
                    //creation_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [blank] => 1    [verbose] => creation date)
                    'creation_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->creation_dtime;
                        },
                    ],
                    //modif_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [blank] => 1    [verbose] => modification date)
                    'modif_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->modif_dtime;
                        },
                    ],
                    //Foreinkey value-backend_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => Tenant_BankBackend    [blank] =>     [relate_name] => backend)
                    'backend_id' => [
                            'type' => Type::int(),
                            'resolve' => function ($root) {
                                return $root->backend_id;
                            },
                    ],
                    // relations: forenkey
                    
                    
                ];
            }
        ]); //
        $Tenant_BankBackend = new ObjectType([
            'name' => 'Tenant_BankBackend',
            'fields' => function () use (&$Pluf_Tenant){
                return [
                    // List of basic fields
                    
                    //id: Array(    [type] => Pluf_DB_Field_Sequence    [blank] => 1    [verbose] => unique and no repreducable id fro reception)
                    'id' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->id;
                        },
                    ],
                    //title: Array(    [type] => Pluf_DB_Field_Varchar    [blank] =>     [size] => 50)
                    'title' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->title;
                        },
                    ],
                    //description: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [size] => 200)
                    'description' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->description;
                        },
                    ],
                    //symbol: Array(    [type] => Pluf_DB_Field_Varchar    [blank] =>     [size] => 50)
                    'symbol' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->symbol;
                        },
                    ],
                    //home: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [size] => 50)
                    'home' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->home;
                        },
                    ],
                    //redirect: Array(    [type] => Pluf_DB_Field_Varchar    [blank] =>     [size] => 50    [secure] => 1)
                    'redirect' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->redirect;
                        },
                    ],
                    //engine: Array(    [type] => Pluf_DB_Field_Varchar    [blank] =>     [size] => 50)
                    'engine' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->engine;
                        },
                    ],
                    //currency: Array(    [type] => Pluf_DB_Field_Varchar    [blank] =>     [is_null] =>     [size] => 50    [editable] =>     [readable] => 1)
                    'currency' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->currency;
                        },
                    ],
                    //deleted: Array(    [type] => Pluf_DB_Field_Boolean    [blank] =>     [default] =>     [readable] => 1    [editable] => )
                    'deleted' => [
                        'type' => Type::boolean(),
                        'resolve' => function ($root) {
                            return $root->deleted;
                        },
                    ],
                    //creation_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [blank] => 1    [verbose] => creation date)
                    'creation_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->creation_dtime;
                        },
                    ],
                    //modif_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [blank] => 1    [verbose] => modification date)
                    'modif_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->modif_dtime;
                        },
                    ],
                    //Foreinkey value-tenant: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => Pluf_Tenant    [blank] =>     [editable] => )
                    'tenant' => [
                            'type' => Type::int(),
                            'resolve' => function ($root) {
                                return $root->tenant;
                            },
                    ],
                    // relations: forenkey
                    
                    
                ];
            }
        ]); //
        $Pluf_Tenant = new ObjectType([
            'name' => 'Pluf_Tenant',
            'fields' => function () use (&$Pluf_Tenant){
                return [
                    // List of basic fields
                    
                    //id: Array(    [type] => Pluf_DB_Field_Sequence    [blank] => 1    [editable] => )
                    'id' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->id;
                        },
                    ],
                    //level: Array(    [type] => Pluf_DB_Field_Integer    [blank] => 1    [editable] => )
                    'level' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->level;
                        },
                    ],
                    //title: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [size] => 100)
                    'title' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->title;
                        },
                    ],
                    //description: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [is_null] => 1    [size] => 1024    [editable] => 1)
                    'description' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->description;
                        },
                    ],
                    //domain: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [is_null] => 1    [unique] => 1    [size] => 63    [editable] => 1)
                    'domain' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->domain;
                        },
                    ],
                    //subdomain: Array(    [type] => Pluf_DB_Field_Varchar    [blank] =>     [is_null] =>     [unique] => 1    [size] => 63    [editable] => 1)
                    'subdomain' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->subdomain;
                        },
                    ],
                    //validate: Array(    [type] => Pluf_DB_Field_Boolean    [default] =>     [blank] => 1    [editable] => )
                    'validate' => [
                        'type' => Type::boolean(),
                        'resolve' => function ($root) {
                            return $root->validate;
                        },
                    ],
                    //email: Array(    [type] => Pluf_DB_Field_Email    [blank] => 1    [verbose] => Owner email    [editable] => 1    [readable] => 1)
                    'email' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->email;
                        },
                    ],
                    //phone: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [verbose] => Owner phone    [editable] => 1    [readable] => 1)
                    'phone' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->phone;
                        },
                    ],
                    //creation_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [blank] => 1    [editable] => )
                    'creation_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->creation_dtime;
                        },
                    ],
                    //modif_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [blank] => 1    [editable] => )
                    'modif_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->modif_dtime;
                        },
                    ],
                    //Foreinkey value-parent_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => Pluf_Tenant    [blank] => 1    [name] => parent    [graphql_name] => parent    [relate_name] => children    [editable] => 1    [readable] => 1)
                    'parent_id' => [
                            'type' => Type::int(),
                            'resolve' => function ($root) {
                                return $root->parent_id;
                            },
                    ],
                    //Foreinkey object-parent_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => Pluf_Tenant    [blank] => 1    [name] => parent    [graphql_name] => parent    [relate_name] => children    [editable] => 1    [readable] => 1)
                    'parent' => [
                            'type' => $Pluf_Tenant,
                            'resolve' => function ($root) {
                                return $root->get_parent();
                            },
                    ],
                    // relations: forenkey
                    
                    
                ];
            }
        ]); //
        $Shop_Zone = new ObjectType([
            'name' => 'Shop_Zone',
            'fields' => function () use (&$User_Account, &$Shop_Order){
                return [
                    // List of basic fields
                    
                    //id: Array(    [type] => Pluf_DB_Field_Sequence    [blank] =>     [editable] =>     [readable] => 1)
                    'id' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->id;
                        },
                    ],
                    //title: Array(    [type] => Pluf_DB_Field_Varchar    [blank] =>     [is_null] =>     [size] => 250    [editable] => 1    [readable] => 1)
                    'title' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->title;
                        },
                    ],
                    //description: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [is_null] => 1    [size] => 250    [editable] => 1    [readable] => 1)
                    'description' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->description;
                        },
                    ],
                    //creation_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [blank] => 1    [editable] =>     [readable] => 1)
                    'creation_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->creation_dtime;
                        },
                    ],
                    //modif_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [blank] => 1    [editable] =>     [readable] => 1)
                    'modif_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->modif_dtime;
                        },
                    ],
                    //avatar: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [is_null] => 1    [size] => 300    [editable] => 1    [readable] => 1)
                    'avatar' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->avatar;
                        },
                    ],
                    //province: Array(    [type] => Pluf_DB_Field_Varchar    [size] => 100    [is_null] => 1    [editable] => 1    [readable] => 1)
                    'province' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->province;
                        },
                    ],
                    //city: Array(    [type] => Pluf_DB_Field_Varchar    [size] => 100    [is_null] => 1    [editable] => 1    [readable] => 1)
                    'city' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->city;
                        },
                    ],
                    //address: Array(    [type] => Pluf_DB_Field_Varchar    [size] => 500    [is_null] => 1    [editable] => 1    [readable] => 1)
                    'address' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->address;
                        },
                    ],
                    //polygon: Array(    [type] => Pluf_DB_Field_Geometry    [is_null] => 1    [editable] => 1    [readable] => 1)
                    'polygon' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->polygon;
                        },
                    ],
                    //deleted: Array(    [type] => Pluf_DB_Field_Boolean    [blank] =>     [default] =>     [editable] => )
                    'deleted' => [
                        'type' => Type::boolean(),
                        'resolve' => function ($root) {
                            return $root->deleted;
                        },
                    ],
                    //Foreinkey value-owner_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => User_Account    [name] => owner    [graphql_name] => owner    [relate_name] => owned_zones    [blank] => 1    [editable] => 1    [readable] => 1)
                    'owner_id' => [
                            'type' => Type::int(),
                            'resolve' => function ($root) {
                                return $root->owner_id;
                            },
                    ],
                    //Foreinkey object-owner_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => User_Account    [name] => owner    [graphql_name] => owner    [relate_name] => owned_zones    [blank] => 1    [editable] => 1    [readable] => 1)
                    'owner' => [
                            'type' => $User_Account,
                            'resolve' => function ($root) {
                                return $root->get_owner();
                            },
                    ],
                    //Foreinkey value-member: Array(    [type] => Pluf_DB_Field_Manytomany    [model] => User_Account    [name] => members    [graphql_name] => members    [relate_name] => zones    [blank] =>     [editable] => )
                    'members' => [
                            'type' => Type::listOf($User_Account),
                            'resolve' => function ($root) {
                                return $root->get_members_list();
                            },
                    ],
                    // relations: forenkey
                    
                    //Foreinkey list-zone_id: Array()
                    'orders' => [
                            'type' => Type::listOf($Shop_Order),
                            'resolve' => function ($root) {
                                return $root->get_orders_list();
                            },
                    ],
                    
                ];
            }
        ]); //
        $Shop_Agency = new ObjectType([
            'name' => 'Shop_Agency',
            'fields' => function () use (&$User_Account, &$CMS_Content, &$Shop_Order){
                return [
                    // List of basic fields
                    
                    //id: Array(    [type] => Pluf_DB_Field_Sequence    [blank] =>     [editable] =>     [readable] => 1)
                    'id' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->id;
                        },
                    ],
                    //title: Array(    [type] => Pluf_DB_Field_Varchar    [blank] =>     [is_null] =>     [size] => 250    [editable] => 1    [readable] => 1)
                    'title' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->title;
                        },
                    ],
                    //description: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [is_null] => 1    [size] => 250    [editable] => 1    [readable] => 1)
                    'description' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->description;
                        },
                    ],
                    //creation_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [blank] => 1    [verbose] => creation date    [editable] => )
                    'creation_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->creation_dtime;
                        },
                    ],
                    //modif_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [blank] => 1    [verbose] => modification date    [editable] => )
                    'modif_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->modif_dtime;
                        },
                    ],
                    //avatar: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [is_null] => 1    [size] => 300    [editable] => 1    [readable] => 1)
                    'avatar' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->avatar;
                        },
                    ],
                    //province: Array(    [type] => Pluf_DB_Field_Varchar    [size] => 100    [is_null] =>     [editable] => 1    [readable] => 1)
                    'province' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->province;
                        },
                    ],
                    //city: Array(    [type] => Pluf_DB_Field_Varchar    [size] => 100    [is_null] =>     [editable] => 1    [readable] => 1)
                    'city' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->city;
                        },
                    ],
                    //address: Array(    [type] => Pluf_DB_Field_Varchar    [size] => 500    [is_null] => 1    [editable] => 1    [readable] => 1)
                    'address' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->address;
                        },
                    ],
                    //phone: Array(    [type] => Pluf_DB_Field_Varchar    [size] => 50    [is_null] => 1    [editable] => 1    [readable] => 1)
                    'phone' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->phone;
                        },
                    ],
                    //point: Array(    [type] => Pluf_DB_Field_Geometry    [is_null] => 1    [editable] => 1    [readable] => 1)
                    'point' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->point;
                        },
                    ],
                    //deleted: Array(    [type] => Pluf_DB_Field_Boolean    [is_null] =>     [default] =>     [editable] => )
                    'deleted' => [
                        'type' => Type::boolean(),
                        'resolve' => function ($root) {
                            return $root->deleted;
                        },
                    ],
                    //Foreinkey value-owner_id: Array(    [type] => Pluf_DB_Field_Manytomany    [model] => User_Account    [name] => owner    [graphql_name] => owner    [relate_name] => agencies    [editable] => 1    [readable] => 1)
                    'owner' => [
                            'type' => Type::listOf($User_Account),
                            'resolve' => function ($root) {
                                return $root->get_owner_list();
                            },
                    ],
                    //Foreinkey value-content_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => CMS_Content    [name] => content    [graphql_name] => content    [relate_name] => agencies    [is_null] => 1    [editable] => 1    [readable] => 1)
                    'content_id' => [
                            'type' => Type::int(),
                            'resolve' => function ($root) {
                                return $root->content_id;
                            },
                    ],
                    //Foreinkey object-content_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => CMS_Content    [name] => content    [graphql_name] => content    [relate_name] => agencies    [is_null] => 1    [editable] => 1    [readable] => 1)
                    'content' => [
                            'type' => $CMS_Content,
                            'resolve' => function ($root) {
                                return $root->get_content();
                            },
                    ],
                    // relations: forenkey
                    
                    //Foreinkey list-agency_id: Array()
                    'orders' => [
                            'type' => Type::listOf($Shop_Order),
                            'resolve' => function ($root) {
                                return $root->get_orders_list();
                            },
                    ],
                    
                ];
            }
        ]); //
        $Shop_OrderMetafield = new ObjectType([
            'name' => 'Shop_OrderMetafield',
            'fields' => function () use (&$Shop_Order){
                return [
                    // List of basic fields
                    
                    //id: Array(    [type] => Pluf_DB_Field_Sequence    [is_null] =>     [editable] => )
                    'id' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->id;
                        },
                    ],
                    //key: Array(    [type] => Pluf_DB_Field_Varchar    [is_null] =>     [size] => 250    [editable] => 1)
                    'key' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->key;
                        },
                    ],
                    //value: Array(    [type] => Pluf_DB_Field_Varchar    [is_null] =>     [size] => 256    [editable] => 1)
                    'value' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->value;
                        },
                    ],
                    //namespace: Array(    [type] => Pluf_DB_Field_Varchar    [is_null] => 1    [size] => 128    [editable] => 1)
                    'namespace' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->namespace;
                        },
                    ],
                    //Foreinkey value-order_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => Shop_Order    [name] => order    [graphql_name] => order    [relate_name] => metafields    [is_null] =>     [editable] => )
                    'order_id' => [
                            'type' => Type::int(),
                            'resolve' => function ($root) {
                                return $root->order_id;
                            },
                    ],
                    //Foreinkey object-order_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => Shop_Order    [name] => order    [graphql_name] => order    [relate_name] => metafields    [is_null] =>     [editable] => )
                    'order' => [
                            'type' => $Shop_Order,
                            'resolve' => function ($root) {
                                return $root->get_order();
                            },
                    ],
                    // relations: forenkey
                    
                    
                ];
            }
        ]); //
        $Shop_OrderItem = new ObjectType([
            'name' => 'Shop_OrderItem',
            'fields' => function () use (&$Shop_Order, &$Shop_OrderItemMetafield){
                return [
                    // List of basic fields
                    
                    //id: Array(    [type] => Pluf_DB_Field_Sequence    [blank] =>     [editable] =>     [readable] => 1)
                    'id' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->id;
                        },
                    ],
                    //title: Array(    [type] => Pluf_DB_Field_Varchar    [blank] =>     [size] => 250    [editable] =>     [readable] => 1)
                    'title' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->title;
                        },
                    ],
                    //item_id: Array(    [type] => Pluf_DB_Field_Integer    [blank] =>     [is_null] =>     [editable] => 1    [readable] => 1)
                    'item_id' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->item_id;
                        },
                    ],
                    //item_type: Array(    [type] => Pluf_DB_Field_Varchar    [blank] =>     [is_null] =>     [size] => 50    [editable] => 1    [readable] => 1)
                    'item_type' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->item_type;
                        },
                    ],
                    //count: Array(    [type] => Pluf_DB_Field_Integer    [blank] =>     [is_null] =>     [default] => 1    [editable] => 1    [readable] => 1)
                    'count' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->count;
                        },
                    ],
                    //price: Array(    [type] => Pluf_DB_Field_Integer    [blank] =>     [is_null] =>     [editable] =>     [readable] => 1)
                    'price' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->price;
                        },
                    ],
                    //off: Array(    [type] => Pluf_DB_Field_Integer    [blank] =>     [is_null] =>     [default] => 0    [editable] =>     [readable] => 1)
                    'off' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->off;
                        },
                    ],
                    //creation_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [blank] => 1    [editable] =>     [readable] => 1)
                    'creation_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->creation_dtime;
                        },
                    ],
                    //Foreinkey value-order_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => Shop_Order    [name] => order    [graphql_name] => order    [relate_name] => order_items    [blank] =>     [editable] =>     [readable] => 1)
                    'order_id' => [
                            'type' => Type::int(),
                            'resolve' => function ($root) {
                                return $root->order_id;
                            },
                    ],
                    //Foreinkey object-order_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => Shop_Order    [name] => order    [graphql_name] => order    [relate_name] => order_items    [blank] =>     [editable] =>     [readable] => 1)
                    'order' => [
                            'type' => $Shop_Order,
                            'resolve' => function ($root) {
                                return $root->get_order();
                            },
                    ],
                    // relations: forenkey
                    
                    //Foreinkey list-order_item_id: Array()
                    'metafields' => [
                            'type' => Type::listOf($Shop_OrderItemMetafield),
                            'resolve' => function ($root) {
                                return $root->get_metafields_list();
                            },
                    ],
                    
                ];
            }
        ]); //
        $Shop_OrderItemMetafield = new ObjectType([
            'name' => 'Shop_OrderItemMetafield',
            'fields' => function () use (&$Shop_OrderItem){
                return [
                    // List of basic fields
                    
                    //id: Array(    [type] => Pluf_DB_Field_Sequence    [is_null] =>     [editable] => )
                    'id' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->id;
                        },
                    ],
                    //key: Array(    [type] => Pluf_DB_Field_Varchar    [is_null] =>     [size] => 250    [editable] => 1)
                    'key' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->key;
                        },
                    ],
                    //value: Array(    [type] => Pluf_DB_Field_Varchar    [is_null] =>     [size] => 256    [editable] => 1)
                    'value' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->value;
                        },
                    ],
                    //Foreinkey value-order_item_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => Shop_OrderItem    [name] => order_item    [graphql_name] => order_item    [relate_name] => metafields    [is_null] =>     [editable] => )
                    'order_item_id' => [
                            'type' => Type::int(),
                            'resolve' => function ($root) {
                                return $root->order_item_id;
                            },
                    ],
                    //Foreinkey object-order_item_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => Shop_OrderItem    [name] => order_item    [graphql_name] => order_item    [relate_name] => metafields    [is_null] =>     [editable] => )
                    'order_item' => [
                            'type' => $Shop_OrderItem,
                            'resolve' => function ($root) {
                                return $root->get_order_item();
                            },
                    ],
                    // relations: forenkey
                    
                    
                ];
            }
        ]); //
        $Shop_OrderHistory = new ObjectType([
            'name' => 'Shop_OrderHistory',
            'fields' => function () use (&$Shop_Order){
                return [
                    // List of basic fields
                    
                    //id: Array(    [type] => Pluf_DB_Field_Sequence    [blank] =>     [is_null] =>     [editable] =>     [readable] => 1)
                    'id' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->id;
                        },
                    ],
                    //object_type: Array(    [type] => Pluf_DB_Field_Varchar    [blank] =>     [is_null] =>     [size] => 100    [editable] =>     [readable] => 1)
                    'object_type' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->object_type;
                        },
                    ],
                    //object_id: Array(    [type] => Pluf_DB_Field_Integer    [blank] =>     [is_null] =>     [editable] =>     [readable] => 1)
                    'object_id' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->object_id;
                        },
                    ],
                    //subject_type: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [is_null] => 1    [size] => 100    [editable] =>     [readable] => 1)
                    'subject_type' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->subject_type;
                        },
                    ],
                    //subject_id: Array(    [type] => Pluf_DB_Field_Integer    [blank] => 1    [is_null] => 1    [editable] =>     [readable] => 1)
                    'subject_id' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->subject_id;
                        },
                    ],
                    //action: Array(    [type] => Pluf_DB_Field_Varchar    [blank] =>     [is_null] =>     [size] => 100    [editable] =>     [readable] => 1)
                    'action' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->action;
                        },
                    ],
                    //workflow: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [size] => 100    [editable] => 1    [readable] => 1)
                    'workflow' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->workflow;
                        },
                    ],
                    //state: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [size] => 50    [editable] => 1    [readable] => 1)
                    'state' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->state;
                        },
                    ],
                    //description: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [is_null] => 1    [size] => 250    [editable] =>     [readable] => 1)
                    'description' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->description;
                        },
                    ],
                    //creation_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [blank] => 1    [editable] =>     [readable] => 1)
                    'creation_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->creation_dtime;
                        },
                    ],
                    //Foreinkey value-order_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => Shop_Order    [blank] =>     [is_null] =>     [name] => order    [graphql_name] => order    [relate_name] => histories    [editable] =>     [readable] => 1)
                    'order_id' => [
                            'type' => Type::int(),
                            'resolve' => function ($root) {
                                return $root->order_id;
                            },
                    ],
                    //Foreinkey object-order_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => Shop_Order    [blank] =>     [is_null] =>     [name] => order    [graphql_name] => order    [relate_name] => histories    [editable] =>     [readable] => 1)
                    'order' => [
                            'type' => $Shop_Order,
                            'resolve' => function ($root) {
                                return $root->get_order();
                            },
                    ],
                    // relations: forenkey
                    
                    
                ];
            }
        ]); //
        $Shop_OrderAttachment = new ObjectType([
            'name' => 'Shop_OrderAttachment',
            'fields' => function () use (&$Shop_Order){
                return [
                    // List of basic fields
                    
                    //id: Array(    [type] => Pluf_DB_Field_Sequence    [blank] =>     [verbose] => first name    [help_text] => id    [editable] => )
                    'id' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->id;
                        },
                    ],
                    //description: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [size] => 2048    [default] => auto created content    [verbose] => description    [help_text] => content description    [editable] => 1)
                    'description' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->description;
                        },
                    ],
                    //mime_type: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [size] => 64    [default] => application/octet-stream    [verbose] => mime type    [help_text] => content mime type    [editable] => 1)
                    'mime_type' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->mime_type;
                        },
                    ],
                    //file_name: Array(    [type] => Pluf_DB_Field_Varchar    [blank] =>     [size] => 250    [default] => unknown    [verbose] => file name    [help_text] => OrderAttachment file name    [editable] => )
                    'file_name' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->file_name;
                        },
                    ],
                    //file_size: Array(    [type] => Pluf_DB_Field_Integer    [blank] =>     [default] => no title    [verbose] => file size    [help_text] => content file size    [editable] => )
                    'file_size' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->file_size;
                        },
                    ],
                    //Foreinkey value-order_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => Shop_Order    [name] => order    [graphql_name] => order    [relate_name] => attachments    [blank] =>     [editable] =>     [readable] => 1)
                    'order_id' => [
                            'type' => Type::int(),
                            'resolve' => function ($root) {
                                return $root->order_id;
                            },
                    ],
                    //Foreinkey object-order_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => Shop_Order    [name] => order    [graphql_name] => order    [relate_name] => attachments    [blank] =>     [editable] =>     [readable] => 1)
                    'order' => [
                            'type' => $Shop_Order,
                            'resolve' => function ($root) {
                                return $root->get_order();
                            },
                    ],
                    // relations: forenkey
                    
                    
                ];
            }
        ]); //
        $Shop_Address = new ObjectType([
            'name' => 'Shop_Address',
            'fields' => function () use (&$User_Account){
                return [
                    // List of basic fields
                    
                    //id: Array(    [type] => Pluf_DB_Field_Sequence    [blank] => 1    [editable] => )
                    'id' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->id;
                        },
                    ],
                    //province: Array(    [type] => Pluf_DB_Field_Varchar    [size] => 100    [is_null] => 1    [editable] => 1    [readable] => 1)
                    'province' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->province;
                        },
                    ],
                    //city: Array(    [type] => Pluf_DB_Field_Varchar    [size] => 100    [is_null] => 1    [editable] => 1    [readable] => 1)
                    'city' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->city;
                        },
                    ],
                    //address: Array(    [type] => Pluf_DB_Field_Varchar    [size] => 500    [is_null] => 1    [editable] => 1    [readable] => 1)
                    'address' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->address;
                        },
                    ],
                    //point: Array(    [type] => Pluf_DB_Field_Geometry    [is_null] => 1    [editable] => 1    [readable] => 1)
                    'point' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->point;
                        },
                    ],
                    //creation_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [blank] => 1    [editable] => )
                    'creation_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->creation_dtime;
                        },
                    ],
                    //modif_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [blank] => 1    [editable] => )
                    'modif_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->modif_dtime;
                        },
                    ],
                    //Foreinkey value-user_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => User_Account    [name] => user    [graphql_name] => user    [relate_name] => addresses    [is_null] => 1    [editable] =>     [readable] => 1)
                    'user_id' => [
                            'type' => Type::int(),
                            'resolve' => function ($root) {
                                return $root->user_id;
                            },
                    ],
                    //Foreinkey object-user_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => User_Account    [name] => user    [graphql_name] => user    [relate_name] => addresses    [is_null] => 1    [editable] =>     [readable] => 1)
                    'user' => [
                            'type' => $User_Account,
                            'resolve' => function ($root) {
                                return $root->get_user();
                            },
                    ],
                    // relations: forenkey
                    
                    
                ];
            }
        ]); //
        $Shop_Contact = new ObjectType([
            'name' => 'Shop_Contact',
            'fields' => function () use (&$User_Account){
                return [
                    // List of basic fields
                    
                    //id: Array(    [type] => Pluf_DB_Field_Sequence    [blank] =>     [editable] =>     [readable] => 1)
                    'id' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->id;
                        },
                    ],
                    //contact: Array(    [type] => Pluf_DB_Field_Varchar    [blank] =>     [is_null] =>     [size] => 250    [editable] => 1    [readable] => 1)
                    'contact' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->contact;
                        },
                    ],
                    //type: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [size] => 50    [editable] => 1    [readable] => 1)
                    'type' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->type;
                        },
                    ],
                    //creation_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [blank] => 1    [editable] =>     [readable] => 1)
                    'creation_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->creation_dtime;
                        },
                    ],
                    //Foreinkey value-user_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => User_Account    [name] => user    [graphql_name] => user    [relate_name] => contacts    [is_null] => 1    [editable] =>     [readable] => 1)
                    'user_id' => [
                            'type' => Type::int(),
                            'resolve' => function ($root) {
                                return $root->user_id;
                            },
                    ],
                    //Foreinkey object-user_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => User_Account    [name] => user    [graphql_name] => user    [relate_name] => contacts    [is_null] => 1    [editable] =>     [readable] => 1)
                    'user' => [
                            'type' => $User_Account,
                            'resolve' => function ($root) {
                                return $root->get_user();
                            },
                    ],
                    // relations: forenkey
                    
                    
                ];
            }
        ]); //
        $Shop_CategoryMetafield = new ObjectType([
            'name' => 'Shop_CategoryMetafield',
            'fields' => function () use (&$Shop_Category){
                return [
                    // List of basic fields
                    
                    //id: Array(    [type] => Pluf_DB_Field_Sequence    [is_null] =>     [editable] => )
                    'id' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->id;
                        },
                    ],
                    //key: Array(    [type] => Pluf_DB_Field_Varchar    [is_null] =>     [size] => 250    [editable] => 1)
                    'key' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->key;
                        },
                    ],
                    //value: Array(    [type] => Pluf_DB_Field_Varchar    [is_null] =>     [size] => 256    [editable] => 1)
                    'value' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->value;
                        },
                    ],
                    //Foreinkey value-category_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => Shop_Category    [name] => category    [graphql_name] => category    [relate_name] => metafields    [is_null] =>     [editable] => )
                    'category_id' => [
                            'type' => Type::int(),
                            'resolve' => function ($root) {
                                return $root->category_id;
                            },
                    ],
                    //Foreinkey object-category_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => Shop_Category    [name] => category    [graphql_name] => category    [relate_name] => metafields    [is_null] =>     [editable] => )
                    'category' => [
                            'type' => $Shop_Category,
                            'resolve' => function ($root) {
                                return $root->get_category();
                            },
                    ],
                    // relations: forenkey
                    
                    
                ];
            }
        ]); //
        $Shop_Delivery = new ObjectType([
            'name' => 'Shop_Delivery',
            'fields' => function () use (&$Shop_Category, &$Shop_Tag, &$Shop_Order){
                return [
                    // List of basic fields
                    
                    //id: Array(    [type] => Pluf_DB_Field_Sequence    [blank] =>     [editable] =>     [readable] => 1)
                    'id' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->id;
                        },
                    ],
                    //title: Array(    [type] => Pluf_DB_Field_Varchar    [blank] =>     [is_null] =>     [size] => 250    [editable] => 1    [readable] => 1)
                    'title' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->title;
                        },
                    ],
                    //description: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [is_null] => 1    [size] => 250    [editable] => 1    [readable] => 1)
                    'description' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->description;
                        },
                    ],
                    //creation_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [blank] => 1    [editable] =>     [readable] => 1)
                    'creation_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->creation_dtime;
                        },
                    ],
                    //modif_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [blank] => 1    [editable] =>     [readable] => 1)
                    'modif_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->modif_dtime;
                        },
                    ],
                    //avatar: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [is_null] => 1    [size] => 300    [editable] => 1    [readable] => 1)
                    'avatar' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->avatar;
                        },
                    ],
                    //price: Array(    [type] => Pluf_DB_Field_Integer    [blank] =>     [is_null] =>     [editable] => 1    [readable] => 1)
                    'price' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->price;
                        },
                    ],
                    //off: Array(    [type] => Pluf_DB_Field_Integer    [blank] => 1    [is_null] => 1    [default] => 0    [editable] => 1    [readable] => 1)
                    'off' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->off;
                        },
                    ],
                    //deleted: Array(    [type] => Pluf_DB_Field_Boolean    [blank] =>     [default] =>     [editable] => )
                    'deleted' => [
                        'type' => Type::boolean(),
                        'resolve' => function ($root) {
                            return $root->deleted;
                        },
                    ],
                    //Foreinkey value-categories: Array(    [type] => Pluf_DB_Field_Manytomany    [model] => Shop_Category    [name] => categories    [graphql_name] => categories    [editable] =>     [readable] => 1    [relate_name] => deliveries)
                    'categories' => [
                            'type' => Type::listOf($Shop_Category),
                            'resolve' => function ($root) {
                                return $root->get_categories_list();
                            },
                    ],
                    //Foreinkey value-tags: Array(    [type] => Pluf_DB_Field_Manytomany    [model] => Shop_Tag    [name] => tags    [graphql_name] => tags    [editable] =>     [readable] => 1    [relate_name] => deliveries)
                    'tags' => [
                            'type' => Type::listOf($Shop_Tag),
                            'resolve' => function ($root) {
                                return $root->get_tags_list();
                            },
                    ],
                    // relations: forenkey
                    
                    
                ];
            }
        ]); //
        $Shop_Tag = new ObjectType([
            'name' => 'Shop_Tag',
            'fields' => function () use (&$Shop_Delivery, &$Shop_Product, &$Shop_Service){
                return [
                    // List of basic fields
                    
                    //id: Array(    [type] => Pluf_DB_Field_Sequence    [blank] =>     [editable] =>     [readable] => 1)
                    'id' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->id;
                        },
                    ],
                    //name: Array(    [type] => Pluf_DB_Field_Varchar    [blank] =>     [is_null] =>     [unique] => 1    [size] => 250    [editable] => 1    [readable] => 1)
                    'name' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->name;
                        },
                    ],
                    //creation_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [blank] => 1    [editable] =>     [readable] => 1)
                    'creation_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->creation_dtime;
                        },
                    ],
                    //modif_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [blank] => 1    [editable] =>     [readable] => 1)
                    'modif_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->modif_dtime;
                        },
                    ],
                    //description: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [is_null] => 1    [size] => 250    [editable] => 1    [readable] => 1)
                    'description' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->description;
                        },
                    ],
                    // relations: forenkey
                    
                    
                    //Foreinkey list-tags: Array()
                    'deliveries' => [
                            'type' => Type::listOf($Shop_Delivery),
                            'resolve' => function ($root) {
                                return $root->get_deliveries_list();
                            },
                    ],
                    //Foreinkey list-tags: Array()
                    'products' => [
                            'type' => Type::listOf($Shop_Product),
                            'resolve' => function ($root) {
                                return $root->get_products_list();
                            },
                    ],
                    //Foreinkey list-tags: Array()
                    'services' => [
                            'type' => Type::listOf($Shop_Service),
                            'resolve' => function ($root) {
                                return $root->get_services_list();
                            },
                    ],
                ];
            }
        ]); //
        $Shop_Product = new ObjectType([
            'name' => 'Shop_Product',
            'fields' => function () use (&$Shop_Category, &$Shop_Tag, &$Shop_TaxClass, &$Shop_ProductMetafield){
                return [
                    // List of basic fields
                    
                    //id: Array(    [type] => Pluf_DB_Field_Sequence    [blank] =>     [editable] =>     [readable] => 1)
                    'id' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->id;
                        },
                    ],
                    //title: Array(    [type] => Pluf_DB_Field_Varchar    [blank] =>     [is_null] =>     [size] => 250    [editable] => 1    [readable] => 1)
                    'title' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->title;
                        },
                    ],
                    //description: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [is_null] => 1    [size] => 250    [editable] => 1    [readable] => 1)
                    'description' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->description;
                        },
                    ],
                    //creation_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [blank] => 1    [editable] =>     [readable] => 1)
                    'creation_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->creation_dtime;
                        },
                    ],
                    //modif_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [blank] => 1    [editable] =>     [readable] => 1)
                    'modif_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->modif_dtime;
                        },
                    ],
                    //avatar: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [is_null] => 1    [size] => 300    [editable] => 1    [readable] => 1)
                    'avatar' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->avatar;
                        },
                    ],
                    //price: Array(    [type] => Pluf_DB_Field_Integer    [blank] =>     [is_null] =>     [editable] => 1    [readable] => 1)
                    'price' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->price;
                        },
                    ],
                    //off: Array(    [type] => Pluf_DB_Field_Integer    [blank] => 1    [is_null] => 1    [default] => 0    [editable] => 1    [readable] => 1)
                    'off' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->off;
                        },
                    ],
                    //deleted: Array(    [type] => Pluf_DB_Field_Boolean    [blank] =>     [default] =>     [editable] => )
                    'deleted' => [
                        'type' => Type::boolean(),
                        'resolve' => function ($root) {
                            return $root->deleted;
                        },
                    ],
                    //Foreinkey value-categories: Array(    [type] => Pluf_DB_Field_Manytomany    [model] => Shop_Category    [name] => categories    [graphql_name] => categories    [editable] =>     [readable] => 1    [relate_name] => products)
                    'categories' => [
                            'type' => Type::listOf($Shop_Category),
                            'resolve' => function ($root) {
                                return $root->get_categories_list();
                            },
                    ],
                    //Foreinkey value-tags: Array(    [type] => Pluf_DB_Field_Manytomany    [model] => Shop_Tag    [name] => tags    [graphql_name] => tags    [editable] =>     [readable] => 1    [relate_name] => products)
                    'tags' => [
                            'type' => Type::listOf($Shop_Tag),
                            'resolve' => function ($root) {
                                return $root->get_tags_list();
                            },
                    ],
                    //manufacturer: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [is_null] => 1    [size] => 250    [editable] => 1    [readable] => 1)
                    'manufacturer' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->manufacturer;
                        },
                    ],
                    //brand: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [is_null] => 1    [size] => 250    [editable] => 1    [readable] => 1)
                    'brand' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->brand;
                        },
                    ],
                    //model: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [is_null] => 1    [size] => 250    [editable] => 1    [readable] => 1)
                    'model' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->model;
                        },
                    ],
                    //properties: Array(    [type] => Pluf_DB_Field_Text    [blank] => 1    [is_null] => 1    [size] => 3000    [editable] => 1    [readable] => 1)
                    'properties' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->properties;
                        },
                    ],
                    //Foreinkey value-taxes: Array(    [type] => Pluf_DB_Field_Manytomany    [model] => Shop_TaxClass    [name] => taxes    [graphql_name] => taxes    [relate_name] => products    [editable] =>     [readable] => 1)
                    'taxes' => [
                            'type' => Type::listOf($Shop_TaxClass),
                            'resolve' => function ($root) {
                                return $root->get_taxes_list();
                            },
                    ],
                    // relations: forenkey
                    
                    //Foreinkey list-product_id: Array()
                    'metafields' => [
                            'type' => Type::listOf($Shop_ProductMetafield),
                            'resolve' => function ($root) {
                                return $root->get_metafields_list();
                            },
                    ],
                    
                ];
            }
        ]); //
        $Shop_TaxClass = new ObjectType([
            'name' => 'Shop_TaxClass',
            'fields' => function () use (&$Shop_Product, &$Shop_Service){
                return [
                    // List of basic fields
                    
                    //id: Array(    [type] => Pluf_DB_Field_Sequence    [blank] =>     [editable] =>     [readable] => 1)
                    'id' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->id;
                        },
                    ],
                    //title: Array(    [type] => Pluf_DB_Field_Varchar    [blank] =>     [size] => 250    [editable] => 1    [readable] => 1)
                    'title' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->title;
                        },
                    ],
                    //rate: Array(    [type] => Pluf_DB_Field_Float    [blank] =>     [editable] => 1    [readable] => 1)
                    'rate' => [
                        'type' => Type::float(),
                        'resolve' => function ($root) {
                            return $root->rate;
                        },
                    ],
                    //creation_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [blank] => 1    [editable] =>     [readable] => 1)
                    'creation_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->creation_dtime;
                        },
                    ],
                    //modif_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [blank] => 1    [editable] =>     [readable] => 1)
                    'modif_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->modif_dtime;
                        },
                    ],
                    // relations: forenkey
                    
                    
                    //Foreinkey list-taxes: Array()
                    'products' => [
                            'type' => Type::listOf($Shop_Product),
                            'resolve' => function ($root) {
                                return $root->get_products_list();
                            },
                    ],
                    //Foreinkey list-taxes: Array()
                    'services' => [
                            'type' => Type::listOf($Shop_Service),
                            'resolve' => function ($root) {
                                return $root->get_services_list();
                            },
                    ],
                ];
            }
        ]); //
        $Shop_Service = new ObjectType([
            'name' => 'Shop_Service',
            'fields' => function () use (&$Shop_Category, &$Shop_Tag, &$Shop_TaxClass, &$Shop_ServiceMetafield){
                return [
                    // List of basic fields
                    
                    //id: Array(    [type] => Pluf_DB_Field_Sequence    [blank] =>     [editable] =>     [readable] => 1)
                    'id' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->id;
                        },
                    ],
                    //title: Array(    [type] => Pluf_DB_Field_Varchar    [blank] =>     [is_null] =>     [size] => 250    [editable] => 1    [readable] => 1)
                    'title' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->title;
                        },
                    ],
                    //description: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [is_null] => 1    [size] => 250    [editable] => 1    [readable] => 1)
                    'description' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->description;
                        },
                    ],
                    //creation_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [blank] => 1    [editable] =>     [readable] => 1)
                    'creation_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->creation_dtime;
                        },
                    ],
                    //modif_dtime: Array(    [type] => Pluf_DB_Field_Datetime    [blank] => 1    [editable] =>     [readable] => 1)
                    'modif_dtime' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->modif_dtime;
                        },
                    ],
                    //avatar: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [is_null] => 1    [size] => 300    [editable] => 1    [readable] => 1)
                    'avatar' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->avatar;
                        },
                    ],
                    //price: Array(    [type] => Pluf_DB_Field_Integer    [blank] =>     [is_null] =>     [editable] => 1    [readable] => 1)
                    'price' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->price;
                        },
                    ],
                    //off: Array(    [type] => Pluf_DB_Field_Integer    [blank] => 1    [is_null] => 1    [default] => 0    [editable] => 1    [readable] => 1)
                    'off' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->off;
                        },
                    ],
                    //deleted: Array(    [type] => Pluf_DB_Field_Boolean    [blank] =>     [default] =>     [editable] => )
                    'deleted' => [
                        'type' => Type::boolean(),
                        'resolve' => function ($root) {
                            return $root->deleted;
                        },
                    ],
                    //Foreinkey value-categories: Array(    [type] => Pluf_DB_Field_Manytomany    [model] => Shop_Category    [name] => categories    [graphql_name] => categories    [editable] =>     [readable] => 1    [relate_name] => services)
                    'categories' => [
                            'type' => Type::listOf($Shop_Category),
                            'resolve' => function ($root) {
                                return $root->get_categories_list();
                            },
                    ],
                    //Foreinkey value-tags: Array(    [type] => Pluf_DB_Field_Manytomany    [model] => Shop_Tag    [name] => tags    [graphql_name] => tags    [editable] =>     [readable] => 1    [relate_name] => services)
                    'tags' => [
                            'type' => Type::listOf($Shop_Tag),
                            'resolve' => function ($root) {
                                return $root->get_tags_list();
                            },
                    ],
                    //properties: Array(    [type] => Pluf_DB_Field_Text    [blank] => 1    [size] => 3000    [editable] => 1    [readable] => 1)
                    'properties' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->properties;
                        },
                    ],
                    //Foreinkey value-taxes: Array(    [type] => Pluf_DB_Field_Manytomany    [model] => Shop_TaxClass    [name] => taxes    [graphql_name] => taxes    [relate_name] => services    [editable] =>     [readable] => 1)
                    'taxes' => [
                            'type' => Type::listOf($Shop_TaxClass),
                            'resolve' => function ($root) {
                                return $root->get_taxes_list();
                            },
                    ],
                    // relations: forenkey
                    
                    //Foreinkey list-service_id: Array()
                    'metafields' => [
                            'type' => Type::listOf($Shop_ServiceMetafield),
                            'resolve' => function ($root) {
                                return $root->get_metafields_list();
                            },
                    ],
                    
                ];
            }
        ]); //
        $Shop_ServiceMetafield = new ObjectType([
            'name' => 'Shop_ServiceMetafield',
            'fields' => function () use (&$Shop_Service){
                return [
                    // List of basic fields
                    
                    //id: Array(    [type] => Pluf_DB_Field_Sequence    [blank] =>     [editable] =>     [readable] => 1)
                    'id' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->id;
                        },
                    ],
                    //key: Array(    [type] => Pluf_DB_Field_Varchar    [is_null] =>     [blank] =>     [size] => 250    [editable] => 1    [readable] => 1)
                    'key' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->key;
                        },
                    ],
                    //value: Array(    [type] => Pluf_DB_Field_Varchar    [is_null] =>     [blank] =>     [size] => 256    [editable] => 1    [readable] => 1)
                    'value' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->value;
                        },
                    ],
                    //unit: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [is_null] => 1    [size] => 64    [editable] => 1    [readable] => 1)
                    'unit' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->unit;
                        },
                    ],
                    //namespace: Array(    [type] => Pluf_DB_Field_Varchar    [is_null] => 1    [blank] => 1    [size] => 128    [editable] => 1    [readable] => 1)
                    'namespace' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->namespace;
                        },
                    ],
                    //Foreinkey value-service_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => Shop_Service    [name] => service    [graphql_name] => service    [relate_name] => metafields    [is_null] =>     [blank] =>     [editable] =>     [readable] => 1)
                    'service_id' => [
                            'type' => Type::int(),
                            'resolve' => function ($root) {
                                return $root->service_id;
                            },
                    ],
                    //Foreinkey object-service_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => Shop_Service    [name] => service    [graphql_name] => service    [relate_name] => metafields    [is_null] =>     [blank] =>     [editable] =>     [readable] => 1)
                    'service' => [
                            'type' => $Shop_Service,
                            'resolve' => function ($root) {
                                return $root->get_service();
                            },
                    ],
                    // relations: forenkey
                    
                    
                ];
            }
        ]); //
        $Shop_ProductMetafield = new ObjectType([
            'name' => 'Shop_ProductMetafield',
            'fields' => function () use (&$Shop_Product){
                return [
                    // List of basic fields
                    
                    //id: Array(    [type] => Pluf_DB_Field_Sequence    [blank] =>     [editable] =>     [readable] => 1)
                    'id' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->id;
                        },
                    ],
                    //key: Array(    [type] => Pluf_DB_Field_Varchar    [is_null] =>     [blank] =>     [size] => 250    [editable] => 1    [readable] => 1)
                    'key' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->key;
                        },
                    ],
                    //value: Array(    [type] => Pluf_DB_Field_Varchar    [is_null] =>     [blank] =>     [size] => 256    [editable] => 1    [readable] => 1)
                    'value' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->value;
                        },
                    ],
                    //unit: Array(    [type] => Pluf_DB_Field_Varchar    [blank] => 1    [is_null] => 1    [size] => 64    [editable] => 1    [readable] => 1)
                    'unit' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->unit;
                        },
                    ],
                    //namespace: Array(    [type] => Pluf_DB_Field_Varchar    [is_null] => 1    [blank] => 1    [size] => 128    [editable] => 1    [readable] => 1)
                    'namespace' => [
                        'type' => Type::string(),
                        'resolve' => function ($root) {
                            return $root->namespace;
                        },
                    ],
                    //Foreinkey value-product_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => Shop_Product    [name] => product    [graphql_name] => product    [relate_name] => metafields    [is_null] =>     [blank] =>     [editable] =>     [readable] => 1)
                    'product_id' => [
                            'type' => Type::int(),
                            'resolve' => function ($root) {
                                return $root->product_id;
                            },
                    ],
                    //Foreinkey object-product_id: Array(    [type] => Pluf_DB_Field_Foreignkey    [model] => Shop_Product    [name] => product    [graphql_name] => product    [relate_name] => metafields    [is_null] =>     [blank] =>     [editable] =>     [readable] => 1)
                    'product' => [
                            'type' => $Shop_Product,
                            'resolve' => function ($root) {
                                return $root->get_product();
                            },
                    ],
                    // relations: forenkey
                    
                    
                ];
            }
        ]);$itemType =$Shop_Category;$rootType =new ObjectType([
            'name' => 'Pluf_paginator',
            'fields' => function () use (&$itemType){
                return [
                    'counts' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->fetchItemsCount();
                        }
                    ],
                    'current_page' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->current_page;
                        }
                    ],
                    'items_per_page' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->items_per_page;
                        }
                    ],
                    'page_number' => [
                        'type' => Type::int(),
                        'resolve' => function ($root) {
                            return $root->getNumberOfPages();
                        }
                    ],
                    'items' => [
                        'type' => Type::listOf($itemType),
                        'resolve' => function ($root) {
                            return $root->fetchItems();
                        }
                    ],
                ];
            }
        ]);
        try {
            $schema = new Schema([
                'query' => $rootType
            ]);
            $result = GraphQL::executeQuery($schema, $query, $rootValue);
            return $result->toArray();
        } catch (Exception $e) {
            throw new Pluf_Exception_BadRequest($e->getMessage());
        }
    }
}
