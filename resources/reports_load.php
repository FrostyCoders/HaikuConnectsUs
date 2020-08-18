<?php
    if(!isset($_POST['order']) || !isset($_POST['done']) || !isset($_POST['page']))
        die(json_encode([false, "Error, missing or wrong data!"]));
    else
    {
        require_once "../config/config.php";
        require_once "db_connect.php";

        switch($_POST['order'])
        {
            case "oldest":
            {
                $order = " ORDER BY add_time ASC";
                break;
            }
            default:
            {
                $order = " ORDER BY add_time DESC";
                break;
            }
        }
        switch($_POST['done'])
        {
            case '1':
            {
                $done = " WHERE solved = 1";
                break;
            }
            default:
            {
                $done = " WHERE solved = 0";
                break;
            }
        }

        $ammount = (intval($_POST['page']) - 1) * 6;
        $limit = " LIMIT 6 OFFSET " . $ammount;

        $pages_sql = "SELECT * FROM haiku_reports" . $done;
        $pages_query = $conn->prepare($pages_sql);

        $sql = "SELECT * FROM haiku_reports" . $done . $order . $limit;
        $query = $conn->prepare($sql);
        

        try
        {
            $query->execute();
            $pages_query->execute();
        }
        catch(Exception $e)
        {
            die(json_encode([false, "Error, cannot download haiku reports! Try later."]));
        }
        
        if($query->rowCount() == 0)
            die(json_encode([false, "No reports to show!"]));
        else
        {
            $pages = $pages_query->rowCount();
            $pages = ceil($pages / 6);
            $reports = $query->fetchAll();
            $list = array();
            foreach($reports as $report)
            {
                array_push($list,
                        array(
                            "id" => $report['report_id'],
                            "email" => $report['guest_email'],
                            "hid" => $report['haiku_id'],
                            "reason" => $report['reason'],
                            "solved" => $report['solved'],
                            "time" => $report['add_time']
                        )
                );
            }

            die(json_encode([true, $pages, $list]));
        }    
    }
?>