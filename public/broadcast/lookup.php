<?php require __DIR__ . "/../../bootstrap.php";

$app = sess();

$params = array(
    'include_annotations' => true,
    'channel_types'       => 'net.app.core.broadcast',
    'include_inactive'    => true,
);

$messages_params = array(
    'include_message_annotations' => true,
    'include_user_annotations'    => false,
);

// check that the user is signed in
if (!$app->getSession()) {
    echo render("unauth_message.twig");
    return;
}

// get the authorised user's data
$auth_user_data = $app->getUser();
$auth_username = $auth_user_data['username'];

$channel_id = !empty($_GET["id"]) ? $_GET["id"] : "34622";

$channel_data = $app->getChannel($channel_id, $params);

$channel_messages = $app->getMessages($channel_id, $params);

foreach ($channel_data['annotations'] as $annotations) {
    if (strpos($annotations['type'], "core.broadcast.metadata") !== false){
        $channel_title = $annotations['value']['title'];
    }
}

echo render(
    "broadcast_lookup.twig",
    array(
        "channel_id"       => $channel_id,
        "channel_data"     => $channel_data,
        "channel_messages" => $channel_messages,
        "channel_title"    => $channel_title,
    )
);
return;
