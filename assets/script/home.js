// Auto Scrolling Down 
window.onload = function () {
    var object = document.getElementById("chat-box");
    object.scrollTop = object.scrollHeight;
}

// Auto-Expanding Textarea
var comfyText = (function(){
var tag = document.querySelectorAll('textarea')
for (var i=0; i<tag.length; i++){
    tag[i].addEventListener('paste',autoExpand)
    tag[i].addEventListener('input',autoExpand)
    tag[i].addEventListener('keyup',autoExpand)
}
function autoExpand(e,el){
    var el = el || e.target
    el.style.height = 'inherit'
    el.style.height = el.scrollHeight+'px'
}
window.addEventListener('load',expandAll)
window.addEventListener('resize',expandAll)
function expandAll(){
    var tag = document.querySelectorAll('textarea')
    for (var i=0; i<tag.length; i++){
    autoExpand(e,tag[i])
    }
}
})();