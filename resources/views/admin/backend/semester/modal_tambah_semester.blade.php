<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah Rombongan Belajar</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <form id="myForm" method="post" action="" enctype="multipart/form-data">
                                                @csrf


                                                <div class="form-group col-md-12">
                                                    <label for="input1" class="form-label">Nama Program Keahlian </label>
                                                    <select name="proka_id" class="mb-3 form-select" aria-label="Default select example">
                                                        <option selected="" disabled>Nama Proka</option>
                                                       
                                                        <option value="{{$item->id}}">aa</option>
                                                   

                                                    </select>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label for="input1" class="form-label">Nama Jurusan </label>
                                                    <select name="jurusan_id" class="mb-3 form-select" aria-label="Default select example">
                                                        <option> </option>

                                                    </select>
                                                </div>
                                                <div class="mb-3 form-group">
                                                    <label class="form-label">Nama Rombel:</label>
                                                    <input type="text" class="form-control" name="nama_rombel">
                                                </div>

                                                <div class="mb-3 form-group">
                                                    <label class="form-label">Wali Kelas:</label>
                                                    <select name="walas_id" class="form-select select2-hidden-accessible" id="single-select-field" data-placeholder="Choose one thing" data-select2-id="select2-data-single-select-field" tabindex="-1" aria-hidden="true">
                                                        <option disabled data-select2-id="select2-data-2-747t">Pilih Nama Walas</option>
                                                      
                                                        <option data-select2-id="select2-data-77-kb3z" value="guru">guru</option>
                                                       


                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <button type="submit" class="px-5 btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            {{-- <button type="submit" class="btn btn-primary">Save changes</button> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>