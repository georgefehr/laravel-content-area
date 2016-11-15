<?php

namespace Cirruslab\LaravelContentArea;

use Illuminate\Database\Eloquent\Model;

class ContentArea extends Model
{

    protected $table = 'cirruslab_content_areas';

    protected $fillable = ['name', 'content'];

    public function getContent()
    {
        $can_edit = config('contentarea.can_edit');

        if(!$can_edit()){
            return $this->content;
        }

        $content = '<div class="laravel-content-area" id="laravel-content-area-'. $this->id .'">';
        $content .= $this->content;
        $content .= '</div>';
            
        $token = csrf_token();
        $content .= <<<EOT
<script>
    var cms_editor_{$this->id} = document.getElementById('laravel-content-area-{$this->id}');
    cms_editor_{$this->id}.setAttribute('contenteditable', true);

    CKEDITOR.inline('laravel-content-area-{$this->id}', {
        removePlugins: 'stylescombo',
        extraPlugins: 'sourcedialog',
        startupFocus: false,
        on:{
            blur: function(event){
                if (event.editor.checkDirty()){
                    var content = event.editor.getData();
                    var request = new XMLHttpRequest();
                    request.open('POST', '/save-content-area', true);
                    request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
                    request.send(encodeURI('content='+ content +'&section_id={$this->id}&_token={$token}'));
                }
           }
       }
    });
</script>
EOT;

        return $content;
    }
}
