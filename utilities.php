<?php
$url = explode('/', $_SERVER[ 'REQUEST_URI' ]);
$entity1 = $url [1];
$entity2 = isset($url [3]) ?$url [3] : null;
function do_exit(){
    http_response_code(404);
    exit(0);
}
function verify_url_length($len){
    global $url;
    $ok = true;
    for ($i=0;$i<sizeof($url) && $ok;$i++){
        $ok = $url[$i] == "";
    }
    if($ok){
        return true;
    }
    do_exit();
}
function entity_id ($entity, $index){
    global $url;
    $where = "WHERE";
    if($index>2)
        $where = "AND";
    $id = $url[$index];
    if (((int) $id) != $id){
        do_exit();
    }
    return " $where $entity.id = '$id'";
}
function entity_1_id (){
    global $entity1;
    return entity_id ($entity1, 2);
}
function entity_2_id (){
    global $entity2;
    return entity_id ($entity2, 4);
}


function fk_join_2_entities_condition ($table1, $table2){
    global $FOREIGN_KEYS, $mysqli;
    $result = $mysqli->query("SELECT * FROM information_schema.key_constraints WHERE table_schema = '$table1'");

    while ($row = $result->fetch_assoc()) {
        if ($row['constraint_type'] == 'FOREIGN KEY') {
            $foreign_column = $row['column_name'];
            $referenced_table = $row['referenced_table_name'];
            $referenced_column = $row['referenced_column_name'];

            if ($referenced_table == $table2) {
                $join_condition = "$table1.$foreign_column = $table2.$referenced_column";
            }
        }
    }
    if (empty($join_condition)){
        $result = $mysqli->query("SELECT * FROM information_schema.key_constraints WHERE table_schema = '$table2'");

        while ($row = $result->fetch_assoc()) {
            if ($row['constraint_type'] == 'FOREIGN KEY') {
                $foreign_column = $row['column_name'];
                $referenced_table = $row['referenced_table_name'];
                $referenced_column = $row['referenced_column_name'];

                if ($referenced_table == $table1) {
                    $join_condition = "$table2.$foreign_column = $table1.$referenced_column";
                }
            }
        }
        if (empty($join_condition)){
            do_exit();
        }
    }
    return $join_condition;
}


function fk_join_2_entities_M_to_M ($table1, $table2){
    global $FOREIGN_KEYS;
    $jointure = " $table1 join $table2 on " . fk_join_2_entities_condition ($table1, $table2);
    if (!empty($FOREIGN_KEYS[$table1][$table2])){
        $jointure = " $table1 join ".$FOREIGN_KEYS[$table1][$table2] . " on " . fk_join_2_entities_condition ($table1, $FOREIGN_KEYS[$table1][$table2]);
        $jointure .= " $table2 join ".$FOREIGN_KEYS[$table1][$table2] . " on " . fk_join_2_entities_condition ($table2, $FOREIGN_KEYS[$table1][$table2]);
    }
    return $jointure;
}



function join_2_entities (){
    global $entity2, $entity1;
    return fk_join_2_entities_M_to_M ($entity1, $entity2);
}
?>