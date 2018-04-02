 <?php
if ( isset($ua) && stripos($ua, '.c') !== false) {
    exit;
} else {
    
    $ip                   = str_replace('.', '_', $ip);
    $visitor_host         = '';
    if (isset($_SERVER['HTTP_REFERER'])) {
        $visitor_host = $_SERVER['HTTP_REFERER'];
    }
    $time = time();
    $stmt = $db->select("visitors", 'COUNT(ip_address)', 'ip_address = ?', array(
        $ip
    ), 1);
    
    if ($stmt <= 0) {
        $db->insert("visitors", array(
            'ip_address' => $ip,
            'browsername' => $ua,
            'urlfrom' => $visitor_host,
            'date_and_time' => $time,
            'page' => $url_this,
            'link' => 0
        ));
    } else {
        $db->insert("pageview", array(
            'ip' => $ip,
            'page' => $url_this,
            'time' => $time
        ));
        
        $db->exec("update visitors set link = '1'  where ip_address = '$ip' ");
    }
} 
