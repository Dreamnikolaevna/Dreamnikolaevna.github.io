async function getSession() {
  let session = await $.post('session.php', {fetch: true}).promise();
  return session;
}

function killSession() {
  $.post('session.php', {kill: true});
}
