add_action( 'wp_loaded', 'ArchiveFilter', 20 );
	add_action('pre_get_posts', 'custom_get_posts', 10, 1);
	
	function ArchiveFilter( $url = false ) {
		if(isset($_GET['archive-filter-reset'])) 
		{
			wp_redirect(get_site_url().'/show/');
			exit();
		}		
	}
	
	function custom_get_posts( $query ) {
		if ( is_admin() || !$query->is_main_query() ){
				return;
		}
		$meta_query = Array('relation' => 'AND');
		if(isset($_GET['afp']))
		{
			if(stristr($_GET['afp'], ';'))
			{
				$meta_query[] = array(
					'key'		=> 'events_prices_price_min',
					'value'		=> (int) explode(";", $_GET['afp'])[0],
					'compare'	=> '>=',
					'type'		=> 'NUMERIC'
				);
				$meta_query[] = array(
					'key'		=> 'events_prices_price_min',
					'value'		=> (int) explode(";", $_GET['afp'])[1],
					'compare'	=> '<=',
					'type'		=> 'NUMERIC'
				);
			}
		}
		if(isset($_GET['afd']))
		{
			if(stristr($_GET['afd'], ';'))
			{
				$meta_query[] = array(
					'key'		=> 'tickets_and_date_0_event_date',
					'value'		=> str_replace('.','', explode(";", $_GET['afd'])[0]),
					'compare'	=> '>='
				);
				
				$meta_query[] = array(
					'key'		=> 'tickets_and_date_0_event_date',
					'value'		=> str_replace('.','', explode(";", $_GET['afd'])[1]),
					'compare'	=> '<='
				);
			}
			else
			{
				$meta_query[] = array(
					'key'		=> 'tickets_and_date_0_event_date',
					'value'		=> str_replace('.','', $_GET['afd']),
					'compare'	=> '='
				);
			}
		}
		$query->set( 'meta_query', $meta_query);
		
		if(isset($_GET['afc'])) $query->set( 'event_type', implode(",", $_GET['afc']));
	}
