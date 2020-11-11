# dbkpu
langkah untuk mobile :
1. login menggunakan session.php
      parameter input JSON {uname:"username", upass:"userpass"} 
      method menggunakan POST
      responses berupa :
        cookies : idpetugas, nama, dan session_id
        konten JSON :
                    haksurat :
                      - idpetugas (idpetugas=username) :: string
                      - nama      (namanya petugas)    :: string
                      - kode      (kode tps)           :: string
                      - namatps   (nama tps)           :: string
                      - dummy_pildpt_lk  (data dpt laki-laki) :: int
                      - dummy_pildpt_pr  (data dpt perempuan) :: int
                      - dummy_pildptb_lk (data dpt tambahan laki-laki) :: int
                      - dummy_pildptb_pr (data dpt tambahan perempuan) :: int
                      - dummy_pildpk_lk  (data dpt surat "kusus" laki-laki) :: int
                      - dummy_pildpk_pr  (data dpt surat "kusus" perempuan) :: int
                      - dummy_disab_data_lk  (data dpt disabilitas laki-laki) :: int
                      - dummy_disab_data_pr  (data dpt disabilitas perempuan) :: int
                      - totsurat total suara(dari dpt, dptb, dpk, dpt disabilitas) yang tiba di tps dari kpu
                    calon :
                        [no1, no2, dst] no1 adalah integer nomer urutan/id calon pertama, no2 adalah urutan/id calon kedua, dst
    setelah login dan mendapatkan json {haksurat:{ idpetugas : ....dst}, calon :[no1, no2, dst]}, maka
2. savepost
    parameter input JSON {
                        - kodepet   (adalah kodeptugas) :: string
                        - dptlk     (adalah data dpt laki-laki, diambil dari session.php, dan dikirim dalam JSON ke savepost) :: int
                        - dptpr     
                        - dptblk
                        - dptbpr
                        - dpklk
                        - dpkpr
                        - dpdislk
                        - dpdispr
                        - hptlk
                        - hptpr
                        - hptblk
                        - hptbpr
                        - hpkpr
                        - hpklk
                        - hpdislk
                        - hpdispr
                        - suararusak
                        - suara
                        - pil1
                        - pil2
                        - tdksah
                }