"use client";

import { useState, useEffect } from "react";
import { motion, Variants } from "framer-motion";
import Image from "next/image";
import Link from "next/link";
import { cn } from "@/lib/utils";

export default function Hero() {
  const [mounted, setMounted] = useState(false);

  useEffect(() => {
    setMounted(true);
  }, []);
  const containerVariants: Variants = {
    hidden: { opacity: 0 },
    visible: {
      opacity: 1,
      transition: { staggerChildren: 0.2 },
    },
  };

  const itemVariants: Variants = {
    hidden: { y: 100, opacity: 0 },
    visible: { y: 0, opacity: 1, transition: { duration: 0.8, ease: [0.22, 1, 0.36, 1] } },
  };

  return (
    <section className="relative min-h-screen flex flex-col justify-between overflow-hidden">
      {/* Background Image */}
      <div className="absolute inset-0 z-0">
        <Image
          src="/images/hero.png"
          alt="Bengaluru Night Skyline"
          fill
          className="object-cover opacity-30 grayscale hover:grayscale-0 transition-all duration-1000 scale-105"
          priority
        />
        <div className="absolute inset-0 bg-gradient-to-r from-brand-bg via-brand-bg/80 to-transparent"></div>
      </div>

      {/* Main Hero Content */}
      <motion.div 
        className="relative z-10 flex-grow flex flex-col justify-center px-6 md:px-24 pt-32 pb-12"
        initial="hidden"
        animate="visible"
        variants={containerVariants}
      >
        <div className="max-w-4xl">
          <div className="space-y-1 overflow-hidden">
            <motion.h1 variants={itemVariants} className="text-5xl md:text-8xl lg:text-[95px] font-heading font-black leading-[0.9]">
              Your Brand.
            </motion.h1>
            <motion.h1 variants={itemVariants} className="text-5xl md:text-8xl lg:text-[95px] font-heading font-black italic text-brand-gold leading-[0.9]">
              Unmissable.
            </motion.h1>
            <motion.h1 variants={itemVariants} className="text-5xl md:text-8xl lg:text-[95px] font-heading font-black leading-[0.9]">
              Everywhere.
            </motion.h1>
          </div>

          <motion.p 
            variants={itemVariants}
            className="mt-8 text-lg md:text-xl text-brand-muted max-w-xl leading-relaxed"
          >
            Premium outdoor advertising across Bengaluru's most strategic corridors.{" "}
            <span className="text-brand-text">Bold, beautiful, impossible to ignore.</span>
          </motion.p>

          <motion.div 
            variants={itemVariants}
            className="mt-12 flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-6"
          >
            <Link
              href="#locations"
              className="bg-brand-gold text-brand-bg px-10 py-4 font-bold uppercase tracking-widest hover:bg-opacity-90 transition-all active:scale-95 text-center"
            >
              Explore Locations
            </Link>
            <Link
              href="#services"
              className="border border-white/20 hover:border-brand-gold px-10 py-4 font-bold uppercase tracking-widest hover:text-brand-gold transition-all active:scale-95 text-center"
            >
              Our Services
            </Link>
          </motion.div>
        </div>
      </motion.div>

      {/* Global Stats Row */}
      <div className="relative z-10 w-full grid grid-cols-2 md:grid-cols-4 border-t border-white/10 bg-brand-bg/50 backdrop-blur-md">
        {[
          { label: "Established", value: "2019" },
          { label: "HQ", value: "Bengaluru" },
          { label: "Active Sites", value: "6+" },
          { label: "Brand Partners", value: "50+" },
        ].map((stat, idx) => (
          <div
            key={idx}
            className={cn(
              "p-6 md:p-8 border-white/10 text-center",
              idx !== 3 && (idx % 2 === 0 || (mounted && window.innerWidth >= 768)) ? "border-r" : ""
            )}
          >
            <span className="block text-brand-gold font-heading text-2xl font-bold">
              {stat.value}
            </span>
            <span className="text-[10px] uppercase tracking-widest text-brand-muted">
              {stat.label}
            </span>
          </div>
        ))}
      </div>
    </section>
  );
}
