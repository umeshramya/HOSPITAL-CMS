<?php
/*
*@package : DoctorAppointment 
*This file generates the class of custom post type

*/ 

class create_custom_post_type{
    /*
     This class is fo craeteing new post_type
     modify the created class please use filters
    */ 

    private $post_type ;//This is name of post_type i.e id
    private $singular  ;//singular name of custom post type

    private $label     ;//this is array which is to be passed to post type in construct some defults are set, but some modifivcation can be dome at level of set_lebels method
    private $args      ;//this is array which is to be passed to post type in construct some defults are set, but some modifivcation can be dome at level of set_lebels method

    
    
    function __construct($cur_post_type, $cur_menu_name, $cur_singular){
        /*
        construcor function for post type
        following fucntion are set by this constructor
            $cur_post_type :-This is name of post_type i.e id
            $cur_menu_name :- Name name to displayed
            $cur_singular  :- singular name 

        rest of the arguments can be modified are add by set_labels and set_args methods        */ 
        
        $this->post_type   = $cur_post_type;
        $this->singular    = $cur_singular;
        $this->label       = array(
                            "name"              => $cur_menu_name,
                            "singular_name"     => $this->singular,
                            );

        $this->args         = array(
                                "public"            => true,
                                "has_archive"       => true,
                                "rewrite"           => true,
                                "capability_type"   => 'post',
                                // 'capabilities'      => array( "create_posts"    => 'do_not_allow'),
                                "map_meta_cap"      => true
                                
                             );
        
    }
    
    function set_lebals($cur_label, $value){
        /*
        This method adds the new lebels and also modifing the existing 
        use this before calling register_custom_post_type
        */ 
        $this->label[$cur_label] = $value;

    }

    function set_args($cur_args, $value){
        /*
        This method adds the new lebels and also modifing the existing 
        use this before calling register_custom_post_type
        */
        $this-> args[$cur_args]=$value;
    }


    function register_custom_post_type(){
        /*
        This method uses register_post_type method 
        after this one has call add_action of wordpress to register custom_post_type

        */ 
        $this->args['labels'] = $this->label;
        
        register_post_type( $this->post_type,  $this->args);        
    }


    function insert_custom_posts(){
        $titles= array_reverse(explode(',' , get_option( $this->post_type)));////this array reverse to make first entey to make it latest post
        // this insert new post from the title array declared in the hospital setting
        foreach ($titles as $title){
            $title=trim($title);
            $post_object= get_page_by_title( $title,  'OBJECT',  $this->post_type);
            if (null==$post_object){
                wp_insert_post( array(
                  'post_name'   =>  $title,
                  'post_type'   => $this->post_type,
                  'post_title' => $title,
                  'post_status' => 'publish'
                ));
              }else{
        
            }

        }


    }


    function read_only_title(){  
            // adds read only title to post
        if(get_post_type() == $this->post_type){
            echo(the_title( "<h1>", "</h1>"));
        }   
          
      }


    

    function hide_add_new_button(){
        // this fucntion hides the Add New button edit.php and also post.php
        global $pagenow;
        if (($pagenow == 'post.php'|| $pagenow == 'edit.php' ) && get_post_type() == $this->post_type){
            echo "<style>";
            echo ".page-title-action{display: none;}";
            echo "</style>";
        }
    }


    function __destruct(){
        // $this->post_type = null;


        
    }





}