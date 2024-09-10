<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<h4 class="page-title">Daftar Riwayat Tamu</h4>
			</div>

			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="add-row" class="display table table-striped table-hover" >
								<thead>
									<tr>
										<th>No</th>
										<th>Kode Booking</th>
										<th>Nama</th>
										<th>Instansi</th>
										<th>Alamat</th>
										<th>No Telp / HP</th>
										<th>Tanggal</th>
										<th>Waktu</th>
										<th>Layanan</th>
										<th>Bidang Tujuan</th>
										<th>Tujuan</th>
										<th>Permasalahan</th>
										<th>Status</th>
										<th>Catatan</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
									<?php
									// PHP code to fetch data
									$query_get_daftar_tamu = $db->prepare("SELECT sidayoh_daftar_tamu.`id_daftar_tamu`, sidayoh_daftar_tamu.`kode_booking`, sidayoh_daftar_tamu.nama, sidayoh_daftar_tamu.no_telp, sidayoh_daftar_tamu.instansi, sidayoh_daftar_tamu.alamat, sidayoh_daftar_tamu.tanggal, sidayoh_daftar_tamu.waktu, sidayoh_daftar_tamu.layanan, sidayoh_bidang.nama_bidang, sidayoh_daftar_tamu.tujuan, sidayoh_daftar_tamu.permasalahan, sidayoh_daftar_tamu.status as status, sidayoh_status_daftar_tamu.status as status_ket, sidayoh_daftar_tamu.catatan, sidayoh_master_opd.instansi as instansi_opd, sidayoh_master_opd.alamat as alamat_opd FROM sidayoh_daftar_tamu JOIN sidayoh_master_opd ON sidayoh_master_opd.id_instansi = sidayoh_daftar_tamu.instansi JOIN sidayoh_bidang ON sidayoh_bidang.id_bidang = sidayoh_daftar_tamu.bidang_tujuan LEFT JOIN sidayoh_status_daftar_tamu ON sidayoh_status_daftar_tamu.id_status = sidayoh_daftar_tamu.status WHERE YEAR(sidayoh_daftar_tamu.tanggal) = :tahun ORDER BY sidayoh_daftar_tamu.id_daftar_tamu DESC");
									$query_get_daftar_tamu->bindParam(':tahun', $tahun);
									$query_get_daftar_tamu->execute();
									$no = 1;
									while ($data_query_get_daftar_tamu = $query_get_daftar_tamu->fetch(PDO::FETCH_ASSOC)) {
										?>
										<tr>
											<td><?php echo $no++; ?></td>
											<td>
												<?php echo $data_query_get_daftar_tamu['kode_booking']; ?>
											</td>
											<td><?php echo $data_query_get_daftar_tamu['nama']; ?></td>
											<td><?php echo $data_query_get_daftar_tamu['instansi_opd']; ?></td>
											<td>
												<?php
												if ($data_query_get_daftar_tamu['instansi'] == 0) {
													echo $data_query_get_daftar_tamu['alamat'];
												} else {
													echo $data_query_get_daftar_tamu['alamat_opd'];
												}
												?>
											</td>
											<td><?php echo $data_query_get_daftar_tamu['no_telp']; ?></td>
											<td><?php echo date("d M Y", strtotime($data_query_get_daftar_tamu['tanggal'])); ?></td>
											<td><?php echo $data_query_get_daftar_tamu['waktu']; ?></td>
											<td><?php echo $data_query_get_daftar_tamu['layanan']; ?></td>
											<td><?php echo $data_query_get_daftar_tamu['nama_bidang']; ?></td>
											<td><?php echo $data_query_get_daftar_tamu['tujuan']; ?></td>
											<td><?php echo $data_query_get_daftar_tamu['permasalahan']; ?></td>
											<form id="guestForm" method="POST">
												<td>
													<input type="hidden" name="kode_booking" value="<?= $data_query_get_daftar_tamu['kode_booking'] ?>">
													<?php
													if ($data_query_get_daftar_tamu['status'] == NULL) {
														$query_get_status_daftar_tamu = $db->prepare("SELECT * FROM sidayoh_status_daftar_tamu");
														$query_get_status_daftar_tamu->execute();
														?>
														<select name="status" required>
															<option selected disabled value="">- Pilih Status -</option>
															<?php
															while ($data_query_get_status_daftar_tamu = $query_get_status_daftar_tamu->fetch(PDO::FETCH_ASSOC)) {
																?>
																<option value="<?= $data_query_get_status_daftar_tamu['id_status'] ?>"><?= $data_query_get_status_daftar_tamu['status'] ?></option>
																<?php
															}
														} else {
															echo $data_query_get_daftar_tamu['status_ket'];
														}
														?>
													</select>
												</td>
												<td>
													<?php
													if ($data_query_get_daftar_tamu['status'] == NULL) {
														?>
														<textarea name="catatan" required></textarea>
														<?php
													} else {
														echo $data_query_get_daftar_tamu['catatan'];
													}
													?>
												</td>
												<td>
													<?php
													if ($data_query_get_daftar_tamu['status'] == NULL) {
														?>
														<button type="submit" name="submit" class="btn btn-primary">Kirim</button>
														<?php
													}
													?>
												</td>
											</form>
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

<script>
		$(document).ready(function() {
			$('form[id^="guestForm-"]').on('submit', function(e) {
				e.preventDefault(); // Prevent page refresh

				$.ajax({
					type: 'POST',
					url: 'proses_edit_daftar_tamu.php',
					data: $(this).serialize(),
					success: function(response) {
						alert(response); // Display response from the server
						// You can add code here to update the table or clear the form
					},
					error: function(xhr, status, error) {
						console.error(xhr.responseText); // Log error to the console
					}
				});
			});
		});
	</script>