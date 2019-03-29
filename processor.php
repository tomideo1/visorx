    <?php
    include_once 'conn.php';
    session_start();
    if (isset($_POST['update'])) {
        $_SESSION['start_date'] = $_POST['start_date'];
        $_SESSION['end_date'] = $_POST['end_date'];
    } 
    else if (!(isset($_SESSION['start_date']) && isset($_SESSION['end_date']))) {
        $_SESSION['start_date'] = date('Y-m-d ',strtotime('-3days'));
        $_SESSION['end_date'] =  $_SESSION['end_date'] = date('Y-m-d');
}   
$start_date = $_SESSION['start_date'];
$end_date = $_SESSION['end_date'];
function convert_kilobytes($data){
    $data = $data/1024;
    return round($data,2);
}
function formatByte($size, $precision = 0){
    $unit = ['B','KB','MB','GB','TB','PB','EB','ZB','YB'];

    for($i = 0; $size >= 1024 && $i < count($unit)-1; $i++){
        $size /= 1024;
    }

    return round($size, $precision).' '.$unit[$i];
}

function formatBytes($size, $precision = 0){

    for($i = 0; $size >= 1024;  $i++){
        $size /= 1024;
    }
    return round($size, $precision);
}


    $sql = "select CONCAT(p.computer_name, '\n', p.logged_on_user) as username,

    sum(p.packet_size) as used_data
    
    from processed_logs p, computers c, mac_addresses m
    
    where c.id = m.computer_id
    
    and p.computer_name = c.computer_name
    
    and (m.mac_address = p.source_mac
    
    or m.mac_address = p.destination_mac)
    
    and p.date_time_logged between '".$start_date.' 00:00:00'."' and '".$end_date.' 23:59:59'."'
    
    and c.active = 1
    
    group by username";
    $query = $conn->query($sql);
    $query->execute();
    $result = $query->fetchALL();
    //Query for Barchart Table

    $sql2 = "select CONCAT(p.computer_name, '\n', p.logged_on_user) as username,

    sum(p.packet_size) as used_data
    
    from processed_logs p, computers c, mac_addresses m
    
    where c.id = m.computer_id
    
    and p.computer_name = c.computer_name
    
    and (m.mac_address = p.source_mac
    
    or m.mac_address = p.destination_mac)
    
    and p.date_time_logged between '".$start_date.' 00:00:00'."' and '".$end_date.' 23:59:59'."'
    
    and c.active = 1
    
    group by username";
    $query2 = $conn->query($sql2);
    $query2->execute();
    $result2 = $query2->fetchALL();
    $arr_mac = array();
    $arr_packets = array();
    foreach($result2 as $row2){
         array_push($arr_mac,$row2['username']);
         $bandwidth_size = $row2['used_data'];
        $bandwidth_size = convert_kilobytes($bandwidth_size);
         array_push($arr_packets,$bandwidth_size);
    }
    $sql3 = "Select url,count(url) as url_count
            from visorx.processed_logs where date_time_logged between '".$start_date."' and '".$end_date.' 23:59:59'."' 
             and url<>'' and url is not null
             group by url order by url_count desc LIMIT 10 
             ";
    $query3 = $conn->query($sql3);
    $query3->execute();
    $result3 = $query3->fetchALL();
    $arr_url = array();
    $arr_url_counts = array();
    foreach($result3 as $row3){
        array_push($arr_url,$row3['url']);
        array_push($arr_url_counts,$row3['url_count']);
    }

    $sql4 = "Select url,sum(packet_size) as url_packet_size
            from visorx.processed_logs where date_time_logged between '".$start_date."' and '".$end_date.' 23:59:59'."'
            and url<>'' and url is not null
             group by url order by url_packet_size desc LIMIT 10";
    $query4 = $conn->query($sql4);
    $query4->execute();
    $result4 = $query4->fetchALL();

    ?>