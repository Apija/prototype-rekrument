<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RekrumentController;
use App\Http\Controllers\LowonganController;

Route ::get('/rekrutment', [RekrumentController::class, 'rekrutment'])->name('rekrutment');
Route :: get ('rekrutment/create', [RekrumentController::class,'create'])->name('rekrutment.create');
Route :: post ('rekrutment/store', [RekrumentController::class,'store'])->name('rekrutment.store');
Route :: get ('rekrutment/edit/{id}', [RekrumentController::class,'edit'])->name('rekrutment.edit');
Route :: put ('rekrutment/update/{id}', [RekrumentController::class,'update'])->name('rekrutment.update');
Route :: delete ('rekrutment/delete/{id}', [RekrumentController::class,'delete'])->name('rekrutment.delete'); 
Route :: put('/rekrutment/{id}/update-status', [RekrumentController::class, 'updateStatus'])->name('rekrutment.updateStatus');

Route ::get('/lowongan', [LowonganController::class, 'lowongan'])->name('lowongan');
Route :: get ('lowongan/create', [LowonganController::class,'create'])->name('lowongan.create');
Route :: post ('lowongan/store', [LowonganController::class,'store'])->name('lowongan.store');
Route :: get ('lowongan/edit/{id}', [LowonganController::class,'edit'])->name('lowongan.edit');
Route :: put ('lowongan/update/{id}', [LowonganController::class,'update'])->name('lowongan.update');
Route :: delete ('lowongan/destroy/{id}', [LowonganController::class,'destroy'])->name('lowongan.destroy'); 
