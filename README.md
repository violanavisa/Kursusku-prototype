# KursusKu - Rumus Biaya Minggu 3

subtotal = fee x participantCount
discount = subtotal x discountPercent / 100
total = subtotal - discount + adminFee

Catatan:
- Semua nilai uang disimpan sebagai integer rupiah.
- Nilai masih hard-code pada Pertemuan 3.
- Input dari form akan ditambahkan pada pertemuan berikutnya.

## Test Case
| No | Fee | Peserta | Diskon | Admin | Expected | Actual | Status |
|----|-----|---------|--------|-------|----------|--------|--------|
| 1  | 350000 | 1 | 0%  | 25000 | 375000  | 375000  | PASS |
| 2  | 350000 | 1 | 10% | 25000 | 340000  | 340000  | PASS |
| 3  | 350000 | 2 | 25% | 25000 | 550000  | 550000  | PASS |
| 4  | 0      | 1 | 10% | 0     | 0       | 0       | PASS |
| 5  | 2500000| 3 | 10% | 50000 | 6800000 | 6800000 | PASS |