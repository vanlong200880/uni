<div class="content-details" id="post-<?php the_ID(); ?>">    
  <h5><?php echo get_field('excerpt'); ?></h5>    
    <?php 			
    the_content();

    wp_link_pages( array('before' => '<div class="page-links">' . __( 'Pages:', 'zerif-lite' ),				'after'  => '</div>',			) );		?></div><?php edit_post_link( __( 'Edit', 'zerif-lite' ), '<span class="edit-link">', '</span>' ); ?>

<?php

  $address = get_field('address');
  if(!empty($address)){
    function geocode($address){
      $address = urlencode($address);
      $url = "http://maps.google.com/maps/api/geocode/json?address={$address}";
      $resp_json = file_get_contents($url);
      $resp = json_decode($resp_json, true);
      if($resp['status']=='OK'){
          $lati = $resp['results'][0]['geometry']['location']['lat'];
          $longi = $resp['results'][0]['geometry']['location']['lng'];
          $formatted_address = $resp['results'][0]['formatted_address'];
          if($lati && $longi && $formatted_address){
              $data_arr = array();            
              array_push(
                  $data_arr, 
                      $lati, 
                      $longi, 
                      $formatted_address
                  );

              return $data_arr;

          }else{
              return false;
          }

      }else{
          return false;
      }
  }
  
  $data_arr = geocode($address);
  if($data_arr){
         
        $latitude = $data_arr[0];
        $longitude = $data_arr[1];
        $formatted_address = $data_arr[2];
  ?>
  <div id="gmap_canvas">Loading map...</div>
      <!-- JavaScript to show google map -->
      <script type="text/javascript" src="http://maps.google.com/maps/api/js"></script>    
      <script type="text/javascript">
          function init_map() {
              var myOptions = {
                  zoom: 14,
                  center: new google.maps.LatLng(<?php echo $latitude; ?>, <?php echo $longitude; ?>),
                  mapTypeId: google.maps.MapTypeId.ROADMAP
              };
              map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);
              marker = new google.maps.Marker({
                  map: map,
                  position: new google.maps.LatLng(<?php echo $latitude; ?>, <?php echo $longitude; ?>)
              });
              infowindow = new google.maps.InfoWindow({
                  content: "<?php echo $formatted_address; ?>"
              });
              google.maps.event.addListener(marker, "click", function () {
                  infowindow.open(map, marker);
              });
              infowindow.open(map, marker);
          }
          google.maps.event.addDomListener(window, 'load', init_map);
      </script>
  
<?php } else{
        echo "No map found.";
    }

  }
?>
