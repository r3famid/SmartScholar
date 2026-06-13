@extends('layouts.app')
@section('title', 'Profil & Pengaturan')
@section('content')
<div class="fade-in">
    <div class="pf">
        <div class="pf-h">
            <div class="pf-av">{{ Auth::user()->initials }}</div>
            <div>
                <h2 class="pf-n">{{ Auth::user()->name }}</h2>
                <p class="pf-d">{{ Auth::user()->email }} · {{ Auth::user()->jenjang_label }}</p>
            </div>
        </div>

        @if(session('success'))
            <div class="ok-msg">✅ {{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" id="profileForm">
            @csrf
            @method('PUT')

            {{-- ====== JENJANG ====== --}}
            <div class="section-lbl">Jenjang Pendidikan</div>
            <div class="jenjang-grid">
                <div class="jbtn {{ Auth::user()->jenjang == 'smp' ? 'active' : '' }}" data-jenjang="smp"><span class="jic">🏫</span>SMP</div>
                <div class="jbtn {{ Auth::user()->jenjang == 'sma' ? 'active' : '' }}" data-jenjang="sma"><span class="jic">🏛️</span>SMA</div>
                <div class="jbtn {{ Auth::user()->jenjang == 'smk' ? 'active' : '' }}" data-jenjang="smk"><span class="jic">🔧</span>SMK</div>
                <div class="jbtn {{ Auth::user()->jenjang == 'kuliah' ? 'active' : '' }}" data-jenjang="kuliah"><span class="jic">🎓</span>Kuliah</div>
                <div class="jbtn {{ Auth::user()->jenjang == 'tidak_bekerja' ? 'active' : '' }}" data-jenjang="tidak_bekerja"><span class="jic">💼</span>Tidak Kuliah</div>
            </div>
            <input type="hidden" name="jenjang" id="jenjangInput" value="{{ old('jenjang', Auth::user()->jenjang ?? 'kuliah') }}">

            {{-- ====== INFO PRIBADI ====== --}}
            <div class="section-lbl">Informasi Pribadi</div>
            <div class="fr">
                <div class="fg"><label>Nama Lengkap</label><input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required></div>
                <div class="fg" id="fg-nim"><label>NIM</label><input type="text" name="nim" value="{{ old('nim', Auth::user()->nim) }}" placeholder="202151047"></div>
            </div>

            {{-- ===================== --}}
            {{-- ===== FIELDS SMP ==== --}}
            {{-- ===================== --}}
            <div id="fields-smp" class="fields-group hidden">
                <div class="fr">
                    <div class="fg"><label>NISN</label><input type="text" name="nisn" value="{{ old('nisn', Auth::user()->nisn) }}" placeholder="0012345678"></div>
                    <div class="fg"><label>Kelas</label>
                        <select name="kelas">
                            <option value="">-- Pilih --</option>
                            <option value="7" {{ Auth::user()->kelas == '7' ? 'selected' : '' }}>7</option>
                            <option value="8" {{ Auth::user()->kelas == '8' ? 'selected' : '' }}>8</option>
                            <option value="9" {{ Auth::user()->kelas == '9' ? 'selected' : '' }}>9</option>
                        </select>
                    </div>
                </div>
                <div class="fg"><label>Nama Sekolah</label><input type="text" name="sekolah" value="{{ old('sekolah', Auth::user()->sekolah) }}" placeholder="SMP Negeri 1 Jakarta"></div>

                <div class="section-lbl">Pengalaman Organisasi</div>
                <div class="fg">
                    <label>Pengalaman Organisasi & Kegiatan Sekolah</label>
                    <textarea name="organisasi" rows="5" class="ta"
                        placeholder="- Ketua OSIS (2024-2025)&#10;- Anggota Pramuka&#10;- Juara lomba matematika tingkat kabupaten&#10;- Panitia acara 17 Agustus sekolah">{{ old('organisasi', Auth::user()->organisasi) }}</textarea>
                    <div style="font-size:10px;color:var(--t3);margin-top:4px">Tulis semua pengalaman organisasi, kegiatan, dan prestasi. Satu baris untuk satu pengalaman.</div>
                </div>
            </div>

            {{-- ===================== --}}
            {{-- ===== FIELDS SMA ==== --}}
            {{-- ===================== --}}
            <div id="fields-sma" class="fields-group hidden">
                <div class="fr">
                    <div class="fg"><label>NISN</label><input type="text" name="nisn" value="{{ old('nisn', Auth::user()->nisn) }}" placeholder="0012345678"></div>
                    <div class="fg"><label>Kelas</label>
                        <select name="kelas">
                            <option value="">-- Pilih --</option>
                            <option value="10" {{ Auth::user()->kelas == '10' ? 'selected' : '' }}>10</option>
                            <option value="11" {{ Auth::user()->kelas == '11' ? 'selected' : '' }}>11</option>
                            <option value="12" {{ Auth::user()->kelas == '12' ? 'selected' : '' }}>12</option>
                        </select>
                    </div>
                </div>
                <div class="fr">
                    <div class="fg"><label>Jurusan</label>
                        <select name="jurusan">
                            <option value="">-- Pilih --</option>
                            <option value="IPA" {{ Auth::user()->jurusan == 'IPA' ? 'selected' : '' }}>IPA</option>
                            <option value="IPS" {{ Auth::user()->jurusan == 'IPS' ? 'selected' : '' }}>IPS</option>
                            <option value="Bahasa" {{ Auth::user()->jurusan == 'Bahasa' ? 'selected' : '' }}>Bahasa</option>
                        </select>
                    </div>
                    <div class="fg"><label>Nama Sekolah</label><input type="text" name="sekolah" value="{{ old('sekolah', Auth::user()->sekolah) }}" placeholder="SMA Negeri 1 Jakarta"></div>
                </div>

                <div class="section-lbl">Pengalaman Organisasi</div>
                <div class="fg">
                    <label>Pengalaman Organisasi & Kegiatan Sekolah</label>
                    <textarea name="organisasi" rows="5" class="ta"
                        placeholder="- Ketua OSIS (2024-2025)&#10;- Sekretaris MPK&#10;- Anggota Paskibra&#10;- Juara Olimpiade Sains tingkat provinsi&#10;- Volunteer kegiatan bakti sosial">{{ old('organisasi', Auth::user()->organisasi) }}</textarea>
                    <div style="font-size:10px;color:var(--t3);margin-top:4px">Tulis semua pengalaman organisasi, kegiatan, dan prestasi. Satu baris untuk satu pengalaman.</div>
                </div>
            </div>

            {{-- ===================== --}}
            {{-- ===== FIELDS SMK ==== --}}
            {{-- ===================== --}}
            <div id="fields-smk" class="fields-group hidden">
                <div class="fr">
                    <div class="fg"><label>NISN</label><input type="text" name="nisn" value="{{ old('nisn', Auth::user()->nisn) }}" placeholder="0012345678"></div>
                    <div class="fg"><label>Kelas</label>
                        <select name="kelas">
                            <option value="">-- Pilih --</option>
                            <option value="10" {{ Auth::user()->kelas == '10' ? 'selected' : '' }}>10</option>
                            <option value="11" {{ Auth::user()->kelas == '11' ? 'selected' : '' }}>11</option>
                            <option value="12" {{ Auth::user()->kelas == '12' ? 'selected' : '' }}>12</option>
                        </select>
                    </div>
                </div>
                <div class="fr">
                    <div class="fg"><label>Jurusan Keahlian</label>
                        <select name="jurusan">
                            <option value="">-- Pilih --</option>
                            <option value="RPL" {{ Auth::user()->jurusan == 'RPL' ? 'selected' : '' }}>Rekayasa Perangkat Lunak</option>
                            <option value="TKJ" {{ Auth::user()->jurusan == 'TKJ' ? 'selected' : '' }}>Teknik Komputer & Jaringan</option>
                            <option value="MM" {{ Auth::user()->jurusan == 'MM' ? 'selected' : '' }}>Multimedia</option>
                            <option value="AKL" {{ Auth::user()->jurusan == 'AKL' ? 'selected' : '' }}>Akuntansi & Keuangan</option>
                            <option value="BDP" {{ Auth::user()->jurusan == 'BDP' ? 'selected' : '' }}>Bisnis Digital & Pemasaran</option>
                            <option value="TBSM" {{ Auth::user()->jurusan == 'TBSM' ? 'selected' : '' }}>Teknik Bisnis Sepeda Motor</option>
                            <option value="TITL" {{ Auth::user()->jurusan == 'TITL' ? 'selected' : '' }}>Teknik Instalasi Tenaga Listrik</option>
                            <option value="TM" {{ Auth::user()->jurusan == 'TM' ? 'selected' : '' }}>Teknik Mesin</option>
                            <option value="HTL" {{ Auth::user()->jurusan == 'HTL' ? 'selected' : '' }}>Hospitality (Perhotelan)</option>
                            <option value="KLN" {{ Auth::user()->jurusan == 'KLN' ? 'selected' : '' }}>Kuliner</option>
                            <option value="Lainnya" {{ Auth::user()->jurusan == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>
                    <div class="fg"><label>Nama Sekolah</label><input type="text" name="sekolah" value="{{ old('sekolah', Auth::user()->sekolah) }}" placeholder="SMK Negeri 1 Jakarta"></div>
                </div>

                <div class="section-lbl">Pengalaman Organisasi & Prakerin</div>
                <div class="fg">
                    <label>Pengalaman Organisasi, Prakerin & Kegiatan</label>
                    <textarea name="organisasi" rows="5" class="ta"
                        placeholder="- Ketua OSIS (2024-2025)&#10;- Prakerin di PT ABC sebagai Web Developer (3 bulan)&#10;- Juara Lomba Kompetensi Siswa (LKS) bidang IT&#10;- Anggota ekstrakurikuler Robotik">{{ old('organisasi', Auth::user()->organisasi) }}</textarea>
                    <div style="font-size:10px;color:var(--t3);margin-top:4px">Tulis pengalaman organisasi, prakerin/PKL, dan prestasi. Satu baris untuk satu pengalaman.</div>
                </div>
            </div>

            {{-- ======================== --}}
            {{-- ===== FIELDS KULIAH ==== --}}
            {{-- ======================== --}}
            <div id="fields-kuliah" class="fields-group hidden">
                <div class="fr">
                    <div class="fg"><label>Jurusan</label><input type="text" name="jurusan" value="{{ old('jurusan', Auth::user()->jurusan) }}" placeholder="Sistem Informasi"></div>
                    <div class="fg"><label>Semester</label>
                        <select name="semester">
                            <option value="">-- Pilih --</option>
                            @for($i = 1; $i <= 8; $i++)
                                <option value="{{ $i }}" {{ Auth::user()->semester == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="fr">
                    <div class="fg"><label>IPK</label><input type="text" name="ipk" value="{{ old('ipk', Auth::user()->ipk) }}" placeholder="3.75"></div>
                    <div class="fg"><label>Universitas</label><input type="text" name="universitas" value="{{ old('universitas', Auth::user()->universitas) }}" placeholder="Universitas Indonesia"></div>
                </div>

                <div class="section-lbl">Pengalaman</div>
                <div class="fg">
                    <label>Pengalaman Kerja, Magang & Proyek</label>
                    <textarea name="experience" rows="5" class="ta"
                        placeholder="- Magang di PT XYZ sebagai Web Developer (6 bulan)&#10;- Freelance UI/UX Designer untuk startup&#10;- Proyek akhir: Sistem informasi akademik berbasis web&#10;- Asisten Dosen mata kuliah Pemrograman Web">{{ old('experience', Auth::user()->experience) }}</textarea>
                    <div style="font-size:10px;color:var(--t3);margin-top:4px">Tulis pengalaman kerja, magang, freelance, dan proyek. Satu baris untuk satu pengalaman.</div>
                </div>
                <div class="fg">
                    <label>Pengalaman Organisasi & Kepanitiaan</label>
                    <textarea name="organisasi" rows="4" class="ta"
                        placeholder="- Ketua BEM Fakultas Ilmu Komputer (2024-2025)&#10;- Panitia acara seminar nasional&#10;- Mentor UKM Kewirausahaan&#10;- Volunteer pengabdian masyarakat">{{ old('organisasi', Auth::user()->organisasi) }}</textarea>
                    <div style="font-size:10px;color:var(--t3);margin-top:4px">Tulis pengalaman organisasi kampus, kepanitiaan, dan kegiatan kemahasiswaan.</div>
                </div>
            </div>

            {{-- =============================== --}}
            {{-- ===== FIELDS TIDAK KULIAH ===== --}}
            {{-- =============================== --}}
            <div id="fields-tidak_bekerja" class="fields-group hidden">
                <div class="fg"><label>Pendidikan Terakhir</label>
                    <select name="last_education">
                        <option value="">-- Pilih --</option>
                        <option value="SD" {{ Auth::user()->last_education == 'SD' ? 'selected' : '' }}>SD / Sederajat</option>
                        <option value="SMP" {{ Auth::user()->last_education == 'SMP' ? 'selected' : '' }}>SMP / Sederajat</option>
                        <option value="SMA" {{ Auth::user()->last_education == 'SMA' ? 'selected' : '' }}>SMA / Sederajat</option>
                        <option value="SMK" {{ Auth::user()->last_education == 'SMK' ? 'selected' : '' }}>SMK / Sederajat</option>
                        <option value="D3" {{ Auth::user()->last_education == 'D3' ? 'selected' : '' }}>D3 (Diploma 3)</option>
                        <option value="S1" {{ Auth::user()->last_education == 'S1' ? 'selected' : '' }}>S1 (Sarjana)</option>
                        <option value="S2" {{ Auth::user()->last_education == 'S2' ? 'selected' : '' }}>S2 (Magister)</option>
                        <option value="Lainnya" {{ Auth::user()->last_education == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>

                <div class="section-lbl">Pengalaman</div>
                <div class="fg">
                    <label>Pengalaman Kerja, Wirausaha & Kegiatan</label>
                    <textarea name="experience" rows="5" class="ta"
                        placeholder="- Bekerja di PT ABC sebagai Staff IT (2 tahun)&#10;- Wirausaha online shop fashion&#10;- Freelance desain grafis&#10;- Mengikuti pelatihan coding bootcamp">{{ old('experience', Auth::user()->experience) }}</textarea>
                    <div style="font-size:10px;color:var(--t3);margin-top:4px">Tulis pengalaman kerja, usaha, freelance, pelatihan, dan kegiatan. Satu baris untuk satu pengalaman.</div>
                </div>
                <div class="fg">
                    <label>Pengalaman Organisasi & Komunitas</label>
                    <textarea name="organisasi" rows="4" class="ta"
                        placeholder="- Anggota komunitas IT Jakarta&#10;- Volunteer kegiatan sosial&#10;- Pengurus karang taruna RT">{{ old('organisasi', Auth::user()->organisasi) }}</textarea>
                    <div style="font-size:10px;color:var(--t3);margin-top:4px">Tulis pengalaman organisasi, komunitas, dan kegiatan sosial.</div>
                </div>
            </div>

            {{-- ====== KEAHLIAN (SEMUA JENJANG) ====== --}}
            <div class="section-lbl">Keahlian & Skill (untuk rekomendasi AI)</div>
            <div class="fg">
                <label>Keahlian (pisahkan dengan koma)</label>
                <input type="text" name="skills" value="{{ old('skills', Auth::user()->skills) }}" placeholder="PHP, JavaScript, SQL, Figma, Excel, Memasak, Otomotif, dll">
                <div style="font-size:10px;color:var(--t3);margin-top:4px">Digunakan oleh AI untuk memberikan rekomendasi personal</div>
            </div>

            <button type="submit" class="sv">Simpan Profil</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
const jenjangBtns = document.querySelectorAll('.jbtn');
const jenjangInput = document.getElementById('jenjangInput');
const allGroups = document.querySelectorAll('.fields-group');
const fgNim = document.getElementById('fg-nim');
const form = document.getElementById('profileForm');

function showJenjang(jenjang) {
    // Sembunyikan semua group
    allGroups.forEach(g => {
        g.classList.add('hidden');
        // DISABLE semua input/select/textarea di group tersembunyi
        g.querySelectorAll('input, select, textarea').forEach(el => {
            el.disabled = true;
        });
    });

    // Tampilkan group yang dipilih
    const target = document.getElementById('fields-' + jenjang);
    if (target) {
        target.classList.remove('hidden');
        // ENABLE semua input/select/textarea di group aktif
        target.querySelectorAll('input, select, textarea').forEach(el => {
            el.disabled = false;
        });
    }

    // NIM hanya untuk kuliah
    if (jenjang === 'kuliah') {
        fgNim.classList.remove('hidden');
        fgNim.querySelector('input').disabled = false;
    } else {
        fgNim.classList.add('hidden');
        fgNim.querySelector('input').disabled = true;
    }
}

// Event klik jenjang
jenjangBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        jenjangBtns.forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        const val = btn.dataset.jenjang;
        jenjangInput.value = val;
        showJenjang(val);
    });
});

// Inisialisasi saat halaman dimuat
const currentJenjang = jenjangInput.value || 'kuliah';
jenjangInput.value = currentJenjang;
showJenjang(currentJenjang);

jenjangBtns.forEach(btn => {
    if (btn.dataset.jenjang === currentJenjang) {
        btn.classList.add('active');
    }
});
</script>
@endsection
