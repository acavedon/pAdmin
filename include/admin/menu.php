<ul class="sf-menu">
   <?if(validaPermissao(array("menu","content"),$arrPermissao)=="1"){?>
   <li>
      <a href="#" accesskey="c">Site <span class="sf-sub-indicator"> »</span></a>
      <ul>
         <?if(validaPermissao(array("navigation"),$arrPermissao)=="1"){?>
         <li>
            <a href="navigation.php">
               <img src="<?=$varCaminho;?>/images/admin/icons/format-justify-fill.gif" width="15" height="15" border="0" align="absmiddle"> Menus
            </a>
         </li>
         <?}?>
         <?if(validaPermissao(array("content"),$arrPermissao)=="1"){?>
         <li>
            <a href="content.php">
               <img src="<?=$varCaminho;?>/images/admin/icons/format-justify-fill.gif" width="15" height="15" border="0" align="absmiddle"> Contents
            </a>
         </li>
         <?}?>
      </ul>
   </li>
   <?}?>
   <li>
      <?if(validaPermissao(array("user","permission","log"),$arrPermissao)=="1"){?>
      <a href="#" class="sf-with-ul" accesskey="m">Management <span class="sf-sub-indicator"> »</span></a>
      <ul>
      <?}?>
         <?if(validaPermissao(array("user"),$arrPermissao)=="1"){?>
         <li>
            <a href="user.php">
               <img src="<?=$varCaminho;?>/images/admin/icons/format-justify-fill.gif" width="15" height="15" border="0" align="absmiddle"> Users
            </a>
         </li>
         <?}?>
         <?if(validaPermissao(array("permission"),$arrPermissao)=="1"){?>
         <li>
            <a href="permission.php">
               <img src="<?=$varCaminho;?>/images/admin/icons/format-justify-fill.gif" width="15" height="15" border="0" align="absmiddle"> Permissions
            </a>
         </li>
         <?}?>
         <?if(validaPermissao(array("log"),$arrPermissao)=="1"){?>
         <li>
            <a href="log.php">
               <img src="<?=$varCaminho;?>/images/admin/icons/format-justify-fill.gif" width="15" height="15" border="0" align="absmiddle"> Logs History
            </a>
         </li>
         <?}?>
      <?if(validaPermissao(array("user","permission","log"),$arrPermissao)=="1"){?>
      </ul>
      <?}?>
      <li>
          <a href="about.php">
            About me
          </a>
      </li>
   </li>
   <li>
      <a href="login.php?acao=logout">Exit</a>
   </li>
</ul>
