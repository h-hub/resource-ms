<?php
	/*
		resource selection page
		populate  first resourse type list
	*/
	function resource_list_form(&$form_state, $my_values = array()){
		
		$form = array();
		$initial_options = resource_type_options();
		$form['resource'] = array(
				'#type' => 'fieldset',
				'#title' => t('Select Base Resource'),
				'#weight' => -10,
			);
		$master_selection = !empty($form_state['values']['resource_type_list']) ? $form_state['values']['resource_type_list'] : t('Strings');
		$form['resource']['resource_type_list'] = array(
		'#type' => 'radios',
		'#title' => 'Select resource type',
		'#options' => $initial_options,
		'#default_value' => $master_selection,
		'#ahah' => array(
				'path' => 'rss/resource_select/callback',
				'wrapper' => 'dependent-dropdown-wrapper',
			),
		);
		$form['resource']['dependent_dropdown_holder'] = array(
			'#tree' => TRUE,
			'#prefix' => '<div id="dependent-dropdown-wrapper">',
			'#suffix' => '</div>',
		);
		$form['resource']['dependent_dropdown_holder']['resource_list'] = array(
			'#type' => 'radios',
			'#required' => FALSE,
			'#title' => t('Resource (changes based on resource type)'),
			
			/*
				when the form is rebuilt during processing (either AJAX or multistep),
				the $master_selction variable will now have the new value and so the
				options will change.
			*/
			'#options' => resource_options($master_selection),
			'#default_value' => isset($my_values['resource_list']) ? $my_values['resource_list'] : '',
		);
		$form['resource']['submit'] = array(
			'#type' => 'submit',
			'#value' => t('Submit'),
			);
		return $form;
	}
	/**
		resource selection page
		The AHAH callback. It processes the form using ahah_example_callback_helper()
		and then
	*/
	function resource_list_form_callback() {
		$form = example_callback_helper();
		$changed_elements = $form['resource']['dependent_dropdown_holder'];
		// Prevent duplicate wrappers.
		unset($changed_elements['#prefix'], $changed_elements['#suffix']);
		
		$output = theme('status_messages') . drupal_render($changed_elements);
		drupal_json(array(
			'status'   => TRUE,
			'data'     => $output,
		));
	}
	/*
		resource selection page
		validate data send from resource_list_form
	*/
	/*
	function resource_list_form_validate($form, &$form_state){
		$resource_name  = $form_state['values']['resource_list'];
		if ($resource_name=='' && $form_state['clicked_button']['#id'] == 'edit-submit'){
				form_set_error('resource_list', t('Please selet resource before submit.'));
		}
	}
	*/
	/*
		resource selection page
		Default submit handler for form. This one happens when the main submit
		button is pressed.
	*/
	function resource_list_form_submit($form, &$form_state) {
	// If an AHAH submission, it's just the dependent dropdown working.
		if (!empty($form_state['ahah_submission'])){
			return;
		}
		elseif($form_state['clicked_button']['#id'] == 'edit-submit'){
			$form_state['rebuild'] = FALSE;
			//drupal_set_message(t('Your values have been submitted. master_dropdown=@first, dependent_dropdown=@second', array('@first' => $form_state['values']['master_dropdown'], '@second' => $form_state['values']['dependent_dropdown_holder']['dependent_dropdown'])));
			$form_state['redirect'] = 'rss/calendar/'.$form_state['values']['dependent_dropdown_holder']['resource_list'];
			return;
		}		
		// edit-next or anything else will cause rebuild.
		$form_state['rebuild'] = TRUE;
	}

	/*
		resource selection page
		return list of resource types
	*/
	function resource_type_options() {
		// drupal_map_assoc() just makes an array('Strings' => 'Strings'...).
		return drupal_map_assoc(array(t('Hall'), t('Lab'), t('Projector'), t('Laptop'), t('Other')));
	}
	/*
		resource selection page
		return resource based  on first selection
	*/
	function resource_options($key = '') {
		//new function class element
		$myFun = new myFun();
		/*
			'#options'=> array(
				'1'=>t('Hall'),
				'2'=>t('Lab'),
				'3'=>t('Projector'),
				'4'=>t('Laptop'),
				'5'=>t('Other'),
			),
		*/
		global $user;
		$uid = $user->uid;
		$options = array(
			t('Hall') => $myFun->reseourceList(1,$uid),
			t('Lab') => $myFun->reseourceList(2,$uid),
			t('Projector') => $myFun->reseourceList(3,$uid),
			t('Laptop') => $myFun->reseourceList(4,$uid),
			t('Other') =>$myFun->reseourceList(5,$uid),
		);
		if (isset($options[$key])){
			return $options[$key];
		}
		else{
			return array();
		}
	}

	/*
		resource selection page
		Does the very standard things that must be done in any normal callback.
		Used by each callback in this module.
	*/
	function example_callback_helper() {
		$form_state = array('storage' => NULL, 'submitted' => FALSE);
		$form_build_id = $_POST['form_build_id'];
		$form = form_get_cache($form_build_id, $form_state);
		$args = $form['#parameters'];
		$form_id = array_shift($args);
		$form_state['post'] = $form['#post'] = $_POST;
		// Enable the submit/validate handlers to determine whether AHAH-submittted.
		$form_state['ahah_submission'] = TRUE;
		$form['#programmed'] = $form['#redirect'] = FALSE;
		drupal_process_form($form_id, $form, $form_state);
		$form = drupal_rebuild_form($form_id, $form_state, $args, $form_build_id);
		return $form;
	}