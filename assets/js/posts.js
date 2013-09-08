jQuery(document).ready(function(w){
    //tinyMCE.activeEditor.getContent()
    //tinyMCE.activeEditor.id
    w('#editor_switch a').click(function(){
        var editor_switch_li = w(this).parent('li');
        if(w(this).data('lang')!=w('#'+tinyMCE.activeEditor.id).data('lang')){
            w('#content_'+w('#'+tinyMCE.activeEditor.id).data('lang')).val(tinyMCE.activeEditor.getContent());
            w('#'+tinyMCE.activeEditor.id).data('lang',w(this).data('lang'));
            tinyMCE.activeEditor.setContent(w('#content_'+w(this).data('lang')).val());
            tinyMCE.activeEditor.nodeChanged();
            editor_switch_li.children('a').addClass('current').removeClass('secondary');
            editor_switch_li.siblings('li').children('a').addClass('secondary').removeClass('current');
        }
        return false;
    });

    w('#post_submit').click(function(){
        w('#content_'+w('#'+tinyMCE.activeEditor.id).data('lang')).val(tinyMCE.activeEditor.getContent());

        return false;
    })
});