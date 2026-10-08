(function(){
  var btn = document.getElementById('themeToggle');
  function set(d){
    document.body.classList.toggle('dark', d);
    if(btn) btn.textContent = d ? 'Modo claro' : 'Modo escuro';
    try{ localStorage.setItem('tema', d ? 'dark' : 'light'); }catch(e){}
  }
  var guardado = null;
  try{ guardado = localStorage.getItem('tema'); }catch(e){}
  var escuro = guardado ? guardado === 'dark' : (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches);
  document.body.classList.toggle('dark', escuro);
  if(btn){ btn.textContent = escuro ? 'Modo claro' : 'Modo escuro'; btn.addEventListener('click', function(){ set(!document.body.classList.contains('dark')); }); }

  var ver = document.getElementById('ver');
  if(ver) ver.addEventListener('click', function(){
    var p = document.getElementById('pass'), v = p.type === 'password';
    p.type = v ? 'text' : 'password';
    ver.textContent = v ? 'Esconder' : 'Mostrar';
  });
})();
