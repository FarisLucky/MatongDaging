

         <div id="content-wrapper">

             <div class="container-fluid">
                 <!-- Card  -->
                 <div class="row flex-grow">
                     <div class="col-12">
                         <div class="card">
                             <div class="card-body">
                                 <h1 class="card-title">Edit Type Id Card</h1>

                                 <form class="forms-sample">
                                     <div class="form-group">
                                         <label for="input_jenis_pembayaran">Type Id Card</label>
                                         <input type="text" class="form-control" id="input_type_id_card" name="edit_type_id_card" value="<?= $select_typeidcard[0]['jenis_pembayaran'] ?>" placeholder="Masukan Type Id Card" reqired>
                                     </div>
                                     <button type="submit" class="btn btn-success mr-2">Submit</button>
                                     <button class="btn btn-light">Cancel</button>
                                 </form>
                             </div>
                         </div>
                     </div>
