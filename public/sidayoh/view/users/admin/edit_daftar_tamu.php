<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Edit Daftar Riwayat Tamu</h4>
				<!--<ul class="breadcrumbs">
					<li class="nav-home">
						<a href="#">
							<i class="flaticon-home"></i>
						</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
						<a href="#">Tables</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
						<a href="#">Datatables</a>
					</li>
				</ul>-->
			</div>

			<div class="col-md-12">
				<div class="card">
					<!--<div class="card-header">
						<div class="d-flex align-items-center">
							<h4 class="card-title">Add Row</h4>
										<button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
											<i class="fa fa-plus"></i>
											Tambah Barang
										</button>
										<a href="?pages=TAMBAH_BARANG" class="btn btn-primary btn-round ml-auto">
											<i class="fa fa-plus"></i>
											Tambah Barang
										</a>
									</div>
								</div>-->
								<div class="card-body">
									<!-- Modal -->
									<div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header no-bd">
													<h5 class="modal-title">
														<span class="fw-mediumbold">
														New</span> 
														<span class="fw-light">
															Row
														</span>
													</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<p class="small">Create a new row using this form, make sure you fill them all</p>
													<form>
														<div class="row">
															<div class="col-sm-12">
																<div class="form-group form-group-default">
																	<label>Name</label>
																	<input id="addName" type="text" class="form-control" placeholder="fill name">
																</div>
															</div>
															<div class="col-md-6 pr-0">
																<div class="form-group form-group-default">
																	<label>Position</label>
																	<input id="addPosition" type="text" class="form-control" placeholder="fill position">
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group form-group-default">
																	<label>Office</label>
																	<input id="addOffice" type="text" class="form-control" placeholder="fill office">
																</div>
															</div>
														</div>
													</form>
												</div>
												<div class="modal-footer no-bd">
													<button type="button" id="addRowButton" class="btn btn-primary">Add</button>
													<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</div>

									<div class="table-responsive">
										<table  class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>No</th>
													<th>Kode Booking</th>
													<th>Nama</th>
													<th>Instansi</th>
													<th>Alamat</th>
													<th>No Telp / HP</th>
													<th>Tanggal</th>
													<th>Wakdsdstu</th>
													<th>Layanan</th>
													<th>Tujuan</th>
													<th>Pemasalahan</th>
													<th>Status</th>
													<th>Catatan</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$query_get_daftar_tamu = $db->prepare("SELECT sidayoh_daftar_tamu.`id_daftar_tamu`,sidayoh_daftar_tamu.`kode_booking`,sidayoh_daftar_tamu.nama,sidayoh_daftar_tamu.no_telp,sidayoh_daftar_tamu.tanggal,sidayoh_daftar_tamu.waktu,sidayoh_daftar_tamu.layanan,sidayoh_daftar_tamu.tujuan,sidayoh_daftar_tamu.permasalahan ,sidayoh_master_opd.instansi as instansi_opd, sidayoh_master_opd.alamat as alamat_opd from sidayoh_daftar_tamu join sidayoh_master_opd on sidayoh_master_opd.id_instansi = sidayoh_daftar_tamu.instansi");
												$query_get_daftar_tamu->execute();
												$no=1;
												while($data_query_get_daftar_tamu = $query_get_daftar_tamu->fetch(PDO::FETCH_ASSOC)){
													?>
													<tr>
														<td><?php echo $no++; ?></td>
														<td><?php echo $data_query_get_daftar_tamu['kode_booking']; ?></td>
														<td><?php echo $data_query_get_daftar_tamu['nama'];?></td>
														<td><?php echo $data_query_get_daftar_tamu['instansi_opd']; ?></td>
														<td><?php echo $data_query_get_daftar_tamu['alamat_opd']; ?></td>
														<td><?php echo $data_query_get_daftar_tamu['no_telp']; ?></td>
														<td><?php echo date("d M Y", strtotime($data_query_get_daftar_tamu['tanggal'])); ?></td>
														<td><?php echo $data_query_get_daftar_tamu['waktu']; ?></td>
														<td><?php echo $data_query_get_daftar_tamu['layanan']; ?></td>
														<td><?php echo $data_query_get_daftar_tamu['tujuan']; ?></td>
														<td><?php echo $data_query_get_daftar_tamu['permasalahan']; ?></td>
														<td>
															<select>
																<option selected="" disabled="">Choose</option>
																<option>Selesai</option>
																<option>Proses</option>
																<option>Bermasalah</option>	
															</select>
														</td>
														<td>
															<textarea></textarea>
														</td>
														</tr>
														<?php
													}
													?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>