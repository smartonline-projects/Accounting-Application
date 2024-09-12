

			
				<?php 
                $level=$this->session->userdata('level');
				$_menu=$this->session->userdata('menuapp');
				$_submenu=$this->session->userdata('submenuapp');
				?>

                <?php if($this->M_global->cek_menu($level,100)>0) {?>
				<?php if($_menu=='100'){?>
                <li class="active"> <?php } else { ?>				
				<li><?php } ?>
					<a href="javascript:;">
						<i class="fa fa-money"></i>
						<span class="title">
                            Kas/Bank
						</span>
						<?php if($_menu=='100'){?>
						<span class="selected"></span> <?php } else { ?>				
						<span class="arrow"></span><?php } ?>
					</a>
					<ul class="sub-menu">
					    
						<?php if($this->M_global->cek_menu($level,120)>0) {?>
                        	<?php if($_submenu=='120'){?>
						    <li class="active"><?php } else { ?><li><?php } ?>	
							<a href="javascript:;">
								Transaksi
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<li>
								    <?php if($this->M_global->cek_menu($level,121)>0) {?>
									<?php if($_submenu=='121'){?>
						             <li class="active"><?php } else { ?><li><?php } ?>		
									<a href="<?php echo base_url(); ?>keuangan_masuk">
										<i class="fa fa-plus-circle"></i>
                                        Penerimaan
									</a>
									<?php }?>																		
									<?php if($this->M_global->cek_menu($level,122)>0) {?>
									<a href="<?php echo base_url(); ?>keuangan_keluar">
										<i class="fa fa-minus-circle"></i>
                                        Pembayaran
									</a>
									<?php } ?>
									<?php if($this->M_global->cek_menu($level,123)>0) {?>
									<a href="<?php echo base_url(); ?>keuangan_transfer">
										<i class="fa fa-exchange"></i>
                                        Transfer Bank
									</a>
									<?php } ?>
			
								</li>
                            </ul>
						</li>
										
						<?php } ?>																						
                        <?php if($this->M_global->cek_menu($level,130)>0) {?>
						<?php if($_submenu=='130'){?>
						<li class="active"><?php } else { ?><li><?php } ?>							
							<a href="<?php echo base_url(); ?>keuangan_laporan">
							   Laporan
							</a>
						</li>						
						<?php } ?>
						
					</ul>
				</li>
				<?php } ?>
				
                <?php if($this->M_global->cek_menu($level,200)>0) {?>
				<?php if($_menu=='200'){?>
                <li class="active"> <?php } else { ?>				
				<li><?php } ?>				
					<a href="javascript:;">
						<i class="fa fa-book"></i>
						<span class="title">
                            Buku Besar
						</span>
						<?php if($_menu=='200'){?>
						<span class="selected"></span> <?php } else { ?>				
						<span class="arrow"></span><?php } ?>
					</a>
					<ul class="sub-menu">
					    <?php if($this->M_global->cek_menu($level,210)>0) {?>
						<li>
							<a href="javascript:;">
								Data Master
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<li>
								    <?php if($this->M_global->cek_menu($level,211)>0) {?>
									<?php if($_submenu=='211'){?>
									<li class="active"><?php } else { ?><li><?php } ?>											
										<a href="<?php echo base_url(); ?>akuntansi_akun">
											 Kode Akun
										</a>
									</li>
									<?php } ?>
									
								    <?php if($this->M_global->cek_menu($level,212)>0) {?>
									<?php if($_submenu=='212'){?>
									<li class="active"><?php } else { ?><li><?php } ?>											
										<a href="<?php echo base_url(); ?>akuntansi_sa">
											 Saldo Awal Akun
										</a>
									</li>
									<?php } ?>
									
									
								</li>
                            </ul>
						</li>
						<?php } ?>
						
					
                        											
						<?php if($this->M_global->cek_menu($level,220)>0) {?>
						<li>
							<a href="javascript:;">
								Transaksi
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<li>
								   <?php if($this->M_global->cek_menu($level,221)>0) {?>
									<a href="<?php echo base_url(); ?>akuntansi_jurnal">
										<i class="fa fa-edit"></i>
                                        Entri Jurnal
									</a>
									<?php } ?>
									<?php if($this->M_global->cek_menu($level,222)>0) {?>
									<a href="<?php echo base_url(); ?>akuntansi_ju">
										<i class="fa fa-list"></i>
                                        Daftar Jurnal
									</a>
									<?php } ?>
									
									<?php if($this->M_global->cek_menu($level,224)>0) {?>
									<?php if($_submenu=='224'){?>
									<li class="active"><?php } else { ?><li><?php } ?>											
										<a href="<?php echo base_url(); ?>akuntansi_tutupbuku">
											 Tutup Buku
										</a>
									</li>
									<?php } ?>

								</li>
                            </ul>
						</li>
						<?php } ?>
											
						<?php if($this->M_global->cek_menu($level,230)>0) {?>
						<?php if($_submenu=='230'){?>
						<li class="active"><?php } else { ?><li><?php } ?>											
							<a href="<?php echo base_url(); ?>akuntansi_lap">
								 Laporan
							</a>
						</li>
						<?php } ?>
						<?php if($this->M_global->cek_menu($level,239)>0) {?>
						<?php if($_submenu=='239'){?>
						<li class="active"><?php } else { ?><li><?php } ?>											
							<a href="<?php echo base_url(); ?>akuntansi_import_akun">
								 Import Data Kode Akun
							</a>
						</li>
						<?php } ?>
												
					</ul>
				</li>
                <?php } ?>
                
               <?php if($this->M_global->cek_menu($level,300)>0) {?>
				<?php if($_menu=='300'){?>
                <li class="active"> <?php } else { ?>				
				<li><?php } ?>				
					<a href="<?php echo base_url();?>dashboard_pembelian">
						<i class="fa fa-truck"></i>
						<span class="title">
                            Pembelian
						</span>
						
						<?php if($_menu=='300'){?>
						<span class="selected"></span> <?php } else { ?>				
						<span class="arrow"></span><?php } ?>
					</a>
					<ul class="sub-menu">
                        <?php if($this->M_global->cek_menu($level,310)>0) {?>
						<?php if($_submenu=='310'){?>
						<li class="active"><?php } else { ?><li><?php } ?>											
							<a href="<?php echo base_url(); ?>pembelian_sp">
								 Suplier
							</a>
						</li>
						<?php } ?>
																		
												
						<?php if($this->M_global->cek_menu($level,320)>0) {?>
						<li>
							<a href="javascript:;">
								Transaksi
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<li>
								   <?php if($this->M_global->cek_menu($level,321)>0) {?>
									<a href="<?php echo base_url(); ?>pembelian_pesanan">
										
                                        Pesanan Pembelian
									</a>
									<?php } ?>
									<?php if($this->M_global->cek_menu($level,322)>0) {?>
									<a href="<?php echo base_url(); ?>pembelian_penerimaan">
										
                                        Penerimaan Barang
									</a>
									<?php } ?>
									<?php if($this->M_global->cek_menu($level,323)>0) {?>
									<a href="<?php echo base_url(); ?>pembelian_faktur">
										
                                        Faktur Pembelian
									</a>
									<?php } ?>
									<?php if($this->M_global->cek_menu($level,324)>0) {?>
									<a href="<?php echo base_url(); ?>pembelian_uangmuka">
										
                                        Uang Muka Pembelian
									</a>
									<?php } ?>
									<?php if($this->M_global->cek_menu($level,325)>0) {?>
									<a href="<?php echo base_url(); ?>pembelian_bayar">
										
                                        Pembayaran Pembelian
									</a>
									<?php } ?>
									<?php if($this->M_global->cek_menu($level,326)>0) {?>
									<a href="<?php echo base_url(); ?>pembelian_retur">
										
                                        Retur Pembelian
									</a>
									<?php } ?>
									

								</li>
                            </ul>
						</li>
						<?php } ?>
						
						<?php if($this->M_global->cek_menu($level,330)>0) {?>
						<?php if($_submenu=='330'){?>
						<li class="active"><?php } else { ?><li><?php } ?>											
							<a href="<?php echo base_url(); ?>pembelian_lap">
								 Laporan
							</a>
						</li>
						<?php } ?>
												
					</ul>
				</li>
                <?php } ?> 
				
			  <?php if($this->M_global->cek_menu($level,400)>0) {?>
				<?php if($_menu=='400'){?>
                <li class="active"> <?php } else { ?>				
				<li><?php } ?>				
					<a href="javascript:;">
						<i class="fa fa-shopping-cart"></i>
						<span class="title">
                            Penjualan
						</span>
						<?php if($_menu=='400'){?>
						<span class="selected"></span> <?php } else { ?>				
						<span class="arrow"></span><?php } ?>
					</a>
					<ul class="sub-menu">
                        <?php if($this->M_global->cek_menu($level,410)>0) {?>
						<?php if($_submenu=='410'){?>
						<li class="active"><?php } else { ?><li><?php } ?>											
							<a href="<?php echo base_url(); ?>penjualan_cs">
								 Data Customer
							</a>
						</li>
						<?php } ?>
																		
												
						<?php if($this->M_global->cek_menu($level,420)>0) {?>
						<li>
							<a href="javascript:;">
								Transaksi
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<li>
								   <?php if($this->M_global->cek_menu($level,421)>0) {?>
									<a href="<?php echo base_url(); ?>penjualan_pesanan">
										
                                        Pesanan Penjualan
									</a>
									<?php } ?>
									
									<?php if($this->M_global->cek_menu($level,422)>0) {?>
									<a href="<?php echo base_url(); ?>penjualan_pengiriman">
										
                                        Pengiriman Barang
									</a>
									<?php } ?>
									
									<?php if($this->M_global->cek_menu($level,423)>0) {?>
									<a href="<?php echo base_url(); ?>penjualan_faktur">
										
                                        Faktur Penjualan
									</a>
									<?php } ?>
									<?php if($this->M_global->cek_menu($level,424)>0) {?>
									<a href="<?php echo base_url(); ?>penjualan_uangmuka">
										
                                        Uang Muka Penjualan
									</a>
									<?php } ?>
									<?php if($this->M_global->cek_menu($level,425)>0) {?>
									<a href="<?php echo base_url(); ?>penjualan_penerimaan">
										
                                        Penerimaan Penjualan
									</a>
									<?php } ?>
									<?php if($this->M_global->cek_menu($level,426)>0) {?>
									<a href="<?php echo base_url(); ?>penjualan_retur">
										
                                        Retur Penjualan
									</a>
									<?php } ?>
									

								</li>
                            </ul>
						</li>
						<?php } ?>
						
						<?php if($this->M_global->cek_menu($level,430)>0) {?>
						<?php if($_submenu=='430'){?>
						<li class="active"><?php } else { ?><li><?php } ?>											
							<a href="<?php echo base_url(); ?>penjualan_lap">
								 Laporan
							</a>
						</li>
						<?php } ?>
						
						
												
					</ul>
				</li>
                <?php } ?> 	
              
			 
			 
              <?php if($this->M_global->cek_menu($level,500)>0) {?>
				<?php if($_menu=='500'){?>
                <li class="active"> <?php } else { ?>				
				<li><?php } ?>				
					<a href="javascript:;">
						<i class="fa fa-barcode"></i>
						<span class="title">
                            Inventory
						</span>
						<?php if($_menu=='500'){?>
						<span class="selected"></span> <?php } else { ?>				
						<span class="arrow"></span><?php } ?>
					</a>
					<ul class="sub-menu">
                        <?php if($this->M_global->cek_menu($level,510)>0) {?>
						<li>
							<a href="javascript:;">
								Data Master
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<li>
								   <?php if($this->M_global->cek_menu($level,511)>0) {?>
									<a href="<?php echo base_url(); ?>inventory_kat">
										<i class="fa fa-edit"></i>
                                        Kategori 
									</a>
									<?php } ?>
									
									<?php if($this->M_global->cek_menu($level,514)>0) {?>
									<a href="<?php echo base_url(); ?>inventory_rak">
										<i class="fa fa-edit"></i>
                                        Rak
									</a>
									<?php } ?>
									<?php if($this->M_global->cek_menu($level,515)>0) {?>
									<a href="<?php echo base_url(); ?>inventory_gudang">
										<i class="fa fa-edit"></i>
                                        Gudang
									</a>
									<?php } ?>
									<?php if($this->M_global->cek_menu($level,516)>0) {?>
									<a href="<?php echo base_url(); ?>inventory_satuan">
										<i class="fa fa-edit"></i>
                                        Satuan
									</a>
									<?php } ?>
									
									
									<?php if($this->M_global->cek_menu($level,519)>0) {?>
									<a href="<?php echo base_url(); ?>inventory_barang">
										<i class="fa fa-edit"></i>
                                        Barang
									</a>
									<?php } ?>

								</li>
                            </ul>
						</li>
						<?php } ?>
						

																		
												
						<?php if($this->M_global->cek_menu($level,520)>0) {?>
						<li>
							<a href="javascript:;">
								Transaksi
								<span class="arrow">
								</span>
							</a>
							<ul class="sub-menu">
								<li>
								    
								  
									<?php if($this->M_global->cek_menu($level,525)>0) {?>
									<a href="<?php echo base_url(); ?>inventory_tso">
										<i class="fa fa-list"></i>
                                        Stok Opname
									</a>
									<?php } ?>
									
									

								</li>
                            </ul>
						</li>
						<?php } ?>
						
						<?php if($this->M_global->cek_menu($level,530)>0) {?>
						<?php if($_submenu=='530'){?>
						<li class="active"><?php } else { ?><li><?php } ?>											
							<a href="<?php echo base_url(); ?>inventory_lap">
								 Laporan
							</a>
						</li>
						<?php } ?>
						
						<?php if($this->M_global->cek_menu($level,539)>0) {?>
						<?php if($_submenu=='539'){?>
						<li class="active"><?php } else { ?><li><?php } ?>											
							<a href="<?php echo base_url(); ?>inventory_import">
								 Import Data Barang
							</a>
						</li>
						<?php } ?>
												
					</ul>
				</li>
                <?php } ?> 	
               			
			  <?php if($this->M_global->cek_menu($level,600)>0) {?>
			  <?php if($_menu=='600'){?>
              <li class="active"> <?php } else { ?>				
			  <li><?php } ?>
              
					<a href="javascript:;">
						<i class="fa fa-list"></i>
						<span class="title">
                           Aktiva Tetap
						</span>
						<?php if($_menu=='600'){?>
						<span class="selected"></span> <?php } else { ?>				
						<span class="arrow"></span><?php } ?>
						
					</a>
					<ul class="sub-menu">
                        <?php if($this->M_global->cek_menu($level,611)>0) {?>
						<?php if($_submenu=='611'){?>
						<li class="active"><?php } else { ?><li><?php } ?>							
							<a href="<?php echo base_url(); ?>at_jenis">
								 Jenis Aktiva Tetap
							</a>
						</li>
						<?php } ?>
						
						<?php if($this->M_global->cek_menu($level,612)>0) {?>
						<?php if($_submenu=='612'){?>
						<li class="active"><?php } else { ?><li><?php } ?>							
							<a href="<?php echo base_url(); ?>at_at">
								 Daftar Aktiva Tetap
							</a>
						</li>
						<?php } ?>	
						
						
						<?php if($this->M_global->cek_menu($level,630)>0) {?>
						<?php if($_submenu=='630'){?>
						<li class="active"><?php } else { ?><li><?php } ?>							
							<a href="<?php echo base_url(); ?>at_lap">
								 Laporan
							</a>
							</li>
						</li>
						<?php } ?>
						
                       			
						

					</ul>
				  </li>	
				</li>
				<?php } ?>
				
			  <?php if($this->M_global->cek_menu($level,700)>0) {?>
			  <?php if($_menu=='700'){?>
              <li class="active"> <?php } else { ?>				
			  <li><?php } ?>
              
					<a href="javascript:;">
						<i class="fa fa-users"></i>
						<span class="title">
                           Payroll
						</span>
						<?php if($_menu=='700'){?>
						<span class="selected"></span> <?php } else { ?>				
						<span class="arrow"></span><?php } ?>
						
					</a>
					<ul class="sub-menu">
                        <?php if($this->M_global->cek_menu($level,701)>0) {?>
						<?php if($_submenu=='701'){?>
						<li class="active"><?php } else { ?><li><?php } ?>							
							<a href="<?php echo base_url(); ?>hrd_karyawan">
								 Karyawan
							</a>
						</li>
						<?php } ?>
						
						<?php if($this->M_global->cek_menu($level,702)>0) {?>
						<?php if($_submenu=='702'){?>
						<li class="active"><?php } else { ?><li><?php } ?>							
							<a href="<?php echo base_url(); ?>hrd_jabatan">
								 Jabatan
							</a>
						</li>
						<?php } ?>	
						
						<?php if($this->M_global->cek_menu($level,703)>0) {?>
						<?php if($_submenu=='703'){?>
						<li class="active"><?php } else { ?><li><?php } ?>							
							<a href="<?php echo base_url(); ?>hrd_departemen">
								 Departemen
							</a>
						</li>
						<?php } ?>
						
						<?php if($this->M_global->cek_menu($level,704)>0) {?>
						<?php if($_submenu=='704'){?>
						<li class="active"><?php } else { ?><li><?php } ?>							
							<a href="<?php echo base_url(); ?>hrd_ptkp">
								 PTKP
							</a>
						</li>
						<?php } ?>
                        
						<?php if($this->M_global->cek_menu($level,709)>0) {?>
						<?php if($_submenu=='709'){?>
						<li class="active"><?php } else { ?><li><?php } ?>							
							<a href="<?php echo base_url(); ?>hrd_gaji">
								 Gaji Karyawan
							</a>
							</li>
						</li>
						<?php } ?>
						
						<?php if($this->M_global->cek_menu($level,730)>0) {?>
						<?php if($_submenu=='730'){?>
						<li class="active"><?php } else { ?><li><?php } ?>							
							<a href="<?php echo base_url(); ?>hrd_laporan">
								 Laporan
							</a>
							</li>
						</li>
						<?php } ?>
						
                       			
						

					</ul>
				  </li>	
				</li>
				<?php } ?>
				
               
				
              <?php if($this->M_global->cek_menu($level,900)>0) {?>
			  <?php if($_menu=='900'){?>
              <li class="active"> <?php } else { ?>				
			  <li><?php } ?>
              
					<a href="javascript:;">
						<i class="fa fa-cogs"></i>
						<span class="title">
                           Utilitas
						</span>
						<?php if($_menu=='900'){?>
						<span class="selected"></span> <?php } else { ?>				
						<span class="arrow"></span><?php } ?>
						
					</a>
					<ul class="sub-menu">
                        <?php if($this->M_global->cek_menu($level,901)>0) {?>
						<?php if($_submenu=='901'){?>
						<li class="active"><?php } else { ?><li><?php } ?>							
							<a href="<?php echo base_url(); ?>master_user">
								 Pengguna Aplikasi
							</a>
						</li>
						<?php } ?>
						
						<?php if($this->M_global->cek_menu($level,902)>0) {?>
						<?php if($_submenu=='902'){?>
						<li class="active"><?php } else { ?><li><?php } ?>							
							<a href="<?php echo base_url(); ?>master_user_grup">
								 Grup User
							</a>
						</li>
						<?php } ?>	
                        
						<?php if($this->M_global->cek_menu($level,903)>0) {?>
						<?php if($_submenu=='903'){?>
						<li class="active"><?php } else { ?><li><?php } ?>							
							<a href="<?php echo base_url(); ?>master_unit">
								 Kode Cabang
							</a>
							</li>
						</li>
						<?php } ?>
						
                        <?php if($this->M_global->cek_menu($level,904)>0) {?>
						<?php if($_submenu=='904'){?>
						<li class="active"><?php } else { ?><li><?php } ?>							
							<a href="<?php echo base_url(); ?>master_param">
								 Profile
							</a>
							</li>
						</li>
						<?php } ?>	
						
						<?php if($this->M_global->cek_menu($level,905)>0) {?>
						<?php if($_submenu=='905'){?>
						<li class="active"><?php } else { ?><li><?php } ?>							
							<a href="<?php echo base_url(); ?>master_counter">
								 Nomor Bukti
							</a>
							</li>
						</li>
						<?php } ?>	
						
						<?php if($this->M_global->cek_menu($level,906)>0) {?>
						<?php if($_submenu=='906'){?>
						<li class="active"><?php } else { ?><li><?php } ?>							
							<a href="<?php echo base_url(); ?>master_currency">
								 Mata Uang
							</a>
							</li>
						</li>
						<?php } ?>	
                        											
											
													
						

					</ul>
				  </li>	
				</li>
				<?php } ?>
				<li>&nbsp
				</li>
			
		         
	






