<?php
/**
 * Template Name: Events Template
 *
 * This template needs a page to function!
 */

/**
 * Class Archive
 */
class PageEvents extends MiddleModel {

  public function upcomingEvents() {
    // make sure they are ordered by start date
    $data = \DustPress\Query::get_acf_posts([
      'post_type'      => 'events',
      'posts_per_page' => 4,
      'meta_key'       => 'event_start_date',
      'orderby'        => 'meta_value',
      'order'          => 'ASC'
    ]);

    // echo "<pre>";
    // print_r($data);
    // die;
    return $data;
  }

  public function allEvents() {
    // make sure they are ordered by longest start time
    return \DustPress\Query::get_acf_posts([
      'post_type'       => 'events',
    ]);
  }
}
