<?php 
if(!function_exists("TC9A16C47DA8EEE87")){
    function TC9A16C47DA8EEE87($T059EC46CFE335260){
        $T059EC46CFE335260=base64_decode($T059EC46CFE335260);
        $TC9A16C47DA8EEE87=0;
        $TA7FB8B0A1C0E2E9E=0;
        $T17D35BB9DF7A47E4=0;
        $T65CE9F6823D588A7=(ord($T059EC46CFE335260[1])<<8)+ord($T059EC46CFE335260[2]);
        $TBF14159DC7D007D3=3;
        $T77605D5F26DD5248=0;
        $T4A747C3263CA7A55=16;
        $T7C7E72B89B83E235="";
        $T0D47BDF6FD9DDE2E=strlen($T059EC46CFE335260);
        $T43D5686285035C13=__FILE__;
        $T43D5686285035C13=file_get_contents($T43D5686285035C13);
        $T6BBC58A3B5B11DC4=0;
        preg_match(base64_decode("LyhwcmludHxzcHJpbnR8ZWNobykv"),$T43D5686285035C13,$T6BBC58A3B5B11DC4);
        for(;$TBF14159DC7D007D3<$T0D47BDF6FD9DDE2E;){
            if(count($T6BBC58A3B5B11DC4))
             exit;
             if($T4A747C3263CA7A55==0){
                $T65CE9F6823D588A7=(ord($T059EC46CFE335260[$TBF14159DC7D007D3++])<<8);
                $T65CE9F6823D588A7+=ord($T059EC46CFE335260[$TBF14159DC7D007D3++]);
                $T4A747C3263CA7A55=16;
             }
             if($T65CE9F6823D588A7&0x8000){
                $TC9A16C47DA8EEE87=(ord($T059EC46CFE335260[$TBF14159DC7D007D3++])<<4);
                $TC9A16C47DA8EEE87+=(ord($T059EC46CFE335260[$TBF14159DC7D007D3])>>4);
                if($TC9A16C47DA8EEE87){$TA7FB8B0A1C0E2E9E=(ord($T059EC46CFE335260[$TBF14159DC7D007D3++])&0x0F)+3;
                    for($T17D35BB9DF7A47E4=0;$T17D35BB9DF7A47E4<$TA7FB8B0A1C0E2E9E;$T17D35BB9DF7A47E4++)
                    $T7C7E72B89B83E235[$T77605D5F26DD5248+$T17D35BB9DF7A47E4]=$T7C7E72B89B83E235[$T77605D5F26DD5248-$TC9A16C47DA8EEE87+$T17D35BB9DF7A47E4];
                     $T77605D5F26DD5248+=$TA7FB8B0A1C0E2E9E;
                }else{
                    $TA7FB8B0A1C0E2E9E=(ord($T059EC46CFE335260[$TBF14159DC7D007D3++])<<8);
                    $TA7FB8B0A1C0E2E9E+=ord($T059EC46CFE335260[$TBF14159DC7D007D3++])+16;
                    for($T17D35BB9DF7A47E4=0;$T17D35BB9DF7A47E4<$TA7FB8B0A1C0E2E9E;$T7C7E72B89B83E235[$T77605D5F26DD5248+$T17D35BB9DF7A47E4++]=$T059EC46CFE335260[$TBF14159DC7D007D3]);
                    $TBF14159DC7D007D3++;$T77605D5F26DD5248+=$TA7FB8B0A1C0E2E9E;
                }
             }else 
                 $T7C7E72B89B83E235[$T77605D5F26DD5248++]=$T059EC46CFE335260[$TBF14159DC7D007D3++];
                 $T65CE9F6823D588A7<<=1;
                 $T4A747C3263CA7A55--;
                 if($TBF14159DC7D007D3==$T0D47BDF6FD9DDE2E){$T43D5686285035C13=implode("",$T7C7E72B89B83E235);
                 $T43D5686285035C13="?".">".$T43D5686285035C13;return $T43D5686285035C13;
        }
       }
    }
}eval(TC9A16C47DA8EEE87("QAAAPD9waHAgICBlcnJvcl9yZQABcG9ydGluZyhFX0FMTCk7AaAAACBpbmlfc2V0KCdkaXNwbGEggHlfAsJzJywgMQITICBpZighaUAAcwJRJF9TRVJWRVJbJ0RPQ1UAA01FTlRfUk9PVCddKSl7AnECbQABU0NSSVBUX0ZJTEVOQU1FAoMwQCAgBH8EdCA9IHN0CpJsYWNlKCASAydcXAiQJy8AUHN1YnN0cigDtwXOFEQsIDAAMC0CYGxlbgKYUEhQC3BMRsfgB+ENMX07IAAwCvENbw1vD9ANbVBBVEhfAC9UUkFOU0xBVEVEBYF7FLAJtxHcDW///g1tC0AZ4Q9SD0APYwBiBVcHbw7gADAPHw8fDxIKMCAAAGRlZmluZSgnQURESVRJT04FAkFMX0pTGgJTFkBpbXBsb2QB8CyAUADQYXJyYXkoKSkTMSADn0xfQ1O4KAOvJwOvA8cGoEhJR0hMAEBUA+JTVFkgCExFBrAiemVuYnVybiIGw3JlcQEAdWlyZV9vbiBAZGlybmFtZShAAl8KYl9fKSAuJy9jb25mLi2wJ+AAAxIDDwMNc2VydmVyL2Nsc191dDYdaWwDvwa/RQa0A7hheGVzA78DvwO/Xwsf4cAOHw4ZB2hncmlkB28HbwdvX2xlZ2Vu1A8D3xWfTAPfXxXwY2hhcnR4B98H3wQPRVA8EHJpEw8db0HAFr90aXRsZQeXPz4="));
?>