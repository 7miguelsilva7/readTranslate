
<style>
/* caso queria remover o efeito do link */
a {
  text-decoration: none;
  color: black;
}
p { 
    text-align: justify;
    line-height: 1.7;
    font-size: 20px;

}

</style>

<div id="texto-clicavel">
    
<?php echo htmlspecialchars($_POST['title']); ?>
</p>
<?php echo $_POST['text']; ?>
</div>


<script>
var criarLink = t => `<a target="esquerda" href="https://translate.google.com/m/translate?ie=UTF8&sl=pt-BR&tl=en&q=#en/pt/${t}">${t}</a>`

var criarArrayDeLinks = e => e.textContent.split(' ').filter(i => i !== '' && i !== '\n').map(i => criarLink(i));

function criarLinksEmElementos(pai) {
  const tags = [];

  if (pai.nodeType == 3 && pai.textContent.trim()) { 
    tags.push(...criarArrayDeLinks(e));
  } else {          
    pai.childNodes
       .forEach(
          e => {         
            if (e.nodeType == 3 && e.textContent.trim()) { 
              tags.push(...criarArrayDeLinks(e));
            } else {          
              tags.push(criarLinksEmElementos(e).outerHTML);
            }
        });
  }
  
  if (tags.length) {    
    pai.innerHTML = tags.join(' ');    
  }

  return pai;  
}

function criarTextoClicavel(seletor) {  
  const div = document.querySelector(seletor);
  criarLinksEmElementos(div);
}

criarTextoClicavel('#texto-clicavel');

</script>